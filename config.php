<?php
declare(strict_types=1);

// SCRIPT_NAME is supplied by PHP/Apache, not by the visitor's Host header.
// Under Apache rewriting it identifies this installation's index.php.
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
return [
    'base_path' => $basePath === '/' || $basePath === '.' ? '' : rtrim($basePath, '/'),
    'canonical_origin' => 'https://arquitectostrabajando.com.mx',
    'canonical_base' => '',
    'email' => 'arquitectos_trabajando@yahoo.com.mx',
    'phone' => '442 239 5018',
    'phone_href' => '+524422395018',
    'address' => 'Paseo de Ankara No. 273',
    'locality' => 'Col. Tejeda, Corregidora, Querétaro, México',
    'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Paseo+de+Ankara+273+Tejeda+Corregidora+Queretaro',
];
