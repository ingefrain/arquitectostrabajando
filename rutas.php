<?php
declare(strict_types=1);

$routes = [
    '/' => [
        'view' => 'inicio',
        'section' => 'inicio',
        'title' => 'Arquitectos Trabajando C+S Estudio | Arquitectura, peritajes, valuación y restauración',
        'description' => 'Arquitectura, peritajes y valuación en Querétaro. Restauración de escultura, pintura, murales y retablos, proyecto arquitectónico y asesoría.',
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
        'title' => 'Arquitectura y restauración en Querétaro | Arquitectos Trabajando C+S Estudio',
        'description' => 'Servicios en Querétaro: DRO, peritajes, proyecto arquitectónico y restauración de escultura, pintura, murales y retablos.',
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
    if (isset($service['legacy'])) {
        $legacy['/' . $service['legacy']] = $service['path'];
    }
    $routes[$service['path']] = [
        'view' => 'servicio', 'section' => 'servicios', 'slug' => $slug,
        'title' => $service['title'], 'description' => $service['description'],
    ];
}
// Retired pages are not redirects or public routes and never enter the sitemap.
$retired = [
    '/servicios/obra-nueva',
    '/servicios/construccion-remodelaciones',
    '/servicios/ampliaciones',
    '/servicios/murales-pintura-escultura',
    '/11_Construccion-Obra-Nueva-Queretaro.php',
    '/12_Construccion-Remodelaciones-Queretaro.php',
    '/13_Construccion-Ampliaciones-Queretaro.php',
    '/14_Construccion-Murales-Pintura-Escultura-Queretaro.php',
];
return ['routes' => $routes, 'legacy' => $legacy, 'retired' => $retired];
