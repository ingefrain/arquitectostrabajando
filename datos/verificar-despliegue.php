<?php
declare(strict_types=1);

/** Read only: never regenerate the baseline from the server being checked. */
function verificar_despliegue(string $root, string $manifestPath): array
{
    $raw = @file_get_contents($manifestPath);
    if ($raw === false) {
        throw new RuntimeException('No se puede leer el manifiesto. Genérelo en local e inclúyalo en el despliegue.');
    }
    try {
        $manifest = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $error) {
        throw new RuntimeException('El manifiesto no contiene JSON válido.');
    }
    if (!is_array($manifest) || ($manifest['version'] ?? null) !== 1
        || !is_string($manifest['generated_at'] ?? null)
        || !is_string($manifest['environment'] ?? null)
        || !is_array($manifest['files'] ?? null) || !$manifest['files']) {
        throw new RuntimeException('El manifiesto está vacío o tiene un formato incompatible.');
    }
    $base = realpath($root);
    if ($base === false) {
        throw new RuntimeException('No se puede verificar la instalación.');
    }
    $rows = [];
    foreach ($manifest['files'] as $name => $expected) {
        if (!is_string($name) || !preg_match('~^(?:\.htaccess|[a-zA-Z0-9_-][a-zA-Z0-9_./-]*)$~D', $name)
            || in_array('..', explode('/', $name), true) || in_array('.', explode('/', $name), true)
            || !is_int($expected) || $expected < 0) {
            throw new RuntimeException('El manifiesto contiene una entrada no válida.');
        }
        $path = $base . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $name);
        clearstatcache(true, $path);
        $resolved = realpath($path);
        $actual = null;
        if ($resolved === false) {
            $status = 'Faltante';
        } elseif (strpos($resolved, $base . DIRECTORY_SEPARATOR) !== 0 || !is_file($resolved) || !is_readable($resolved)) {
            $status = 'No verificable';
        } else {
            $size = @filesize($resolved);
            $actual = $size === false ? null : $size;
            $status = $actual === null ? 'No verificable' : ($actual === $expected ? 'Correcto' : 'Tamaño diferente');
        }
        $rows[] = ['file' => $name, 'expected' => $expected, 'actual' => $actual, 'status' => $status];
    }
    $priority = ['Faltante' => 0, 'Tamaño diferente' => 1, 'No verificable' => 2, 'Correcto' => 3];
    usort($rows, static function (array $a, array $b) use ($priority): int {
        $order = $priority[$a['status']] <=> $priority[$b['status']];
        return $order !== 0 ? $order : strcmp($a['file'], $b['file']);
    });
    return ['manifest' => $manifest, 'rows' => $rows];
}
