<?php
declare(strict_types=1);

// SCRIPT_NAME is supplied by PHP/Apache, not by the visitor's Host header.
// Under Apache rewriting it identifies this installation's index.php.
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
// Components of the already published address; visible labels are derived below.
$addressParts = [
    'street' => 'Paseo de Ankara No. 273',
    'district' => 'Col. Tejeda',
    'municipality' => 'Corregidora',
    'state' => 'Querétaro',
    'country' => 'México',
];
return [
    'base_path' => $basePath === '/' || $basePath === '.' ? '' : rtrim($basePath, '/'),
    'canonical_origin' => 'https://arquitectostrabajando.com.mx',
    'canonical_base' => '',
    'business_name' => 'Arquitectos Trabajando C+S Estudio',
    'logo_path' => '/assets/logo-at.png',
    'social_image_path' => '/assets/logo-og.jpg',
    'email' => 'arquitectos_trabajando@yahoo.com.mx',
    'phone' => '442 239 5018',
    'phone_href' => '+524422395018',
    'address_parts' => $addressParts,
    'address' => $addressParts['street'],
    'locality' => implode(', ', array_slice($addressParts, 1)),
    'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Paseo+de+Ankara+273+Tejeda+Corregidora+Queretaro',
];
