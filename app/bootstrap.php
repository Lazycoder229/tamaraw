<?php
// app/bootstrap.php

/**
 * Bootstrap the application by sharing data to all views.
 * This file is loaded in public/index.php before the framework's
 * 
 */
use Core\View\Components\ViewFactory;

ViewFactory::share([
    'navLinks' => [
        ['href' => '/',          'label' => 'Dashboard'],
        ['href' => '/products',  'label' => 'Marketplace'],  // ← add ito
    ],
 
    'headerLayout'  => 'centered-search',
    'headerActions' => [
        'notif'  => null,
        'cart'   => 0,     
        'logout',
    ],
    'headerSearch'  => 'Search products, farms…',
    'pageTitle'     => 'Marketplace',
    'theme'         => 'light',
    
]);