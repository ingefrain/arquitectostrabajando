<?php
declare(strict_types=1);

$routes = [
    '/' => [
        'view' => 'inicio',
        'section' => 'inicio',
        'title' => 'Arquitectos Trabajando C+S Estudio | Arquitectura, peritajes, valuación y construcción',
        'description' => 'Empresa de Querétaro dedicada al diseño arquitectónico, restauración y contrucción de obra nueva, remodelaciones, presupuestos, valuación, maquila de planos y asesoría.',
    ],
    '/contacto' => [
        'view' => 'contacto',
        'section' => 'contacto',
        'title' => 'Despacho de arquitectos en Querétaro | Arquitectos Trabajando C+S Estudio',
        'description' => 'Paseo de Ankara No. 273, Col. Tejeda, Corregidora, Querétaro. Teléfono 442 239 5018 y correo arquitectos_trabajando@yahoo.com.mx.',
    ],
    '/servicios' => [
        'view' => 'servicios',
        'section' => 'servicios',
        'title' => 'Servicios arquitectónicos en Querétaro | Arquitectos Trabajando C+S Estudio',
        'description' => 'DRO y peritajes, proyecto arquitectónico, construcción, presupuestos, planos y levantamientos topográficos en Querétaro.',
    ],
    '/trabajos' => [
        'view' => 'trabajos',
        'section' => 'trabajos',
        'title' => 'Trabajos arquitectónicos en Querétaro | Arquitectos Trabajando C+S Estudio',
        'description' => 'Proyectos y obras del estudio en Querétaro: Escuela Aguazarca, Arco techo, Edificio Centro Sur, Residencia Balvanera y Bodega Miranda.',
    ],
];
$legacy = [
    '/index.php' => '/',
    '/4_Arquitectos-en-Queretaro.html' => '/contacto',
    '/5_Servicios-Arquitectonicos-Queretaro.html' => '/servicios',
    '/3_Trabajos-Arquitectonicos.html' => '/trabajos',
];
foreach ($catalog['services'] as $slug => $service) {
    $legacy['/' . $service['legacy']] = $service['path'];
    $routes[$service['path']] = [
        'view' => 'servicio', 'section' => 'servicios', 'slug' => $slug,
        'title' => $service['title'], 'description' => $service['description'],
    ];
}
return ['routes' => $routes, 'legacy' => $legacy];
