<?php

return [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],


        ['header' => 'CADASTROS'],
        [
            'text' => 'Tipos de Endereços',
            'route' => 'web.admin.address_types.index',
            'icon' => 'fas fa-map-marked-alt', // Remete a localização/endereço
            'can' => 'list,App\\Models\\AddressType',
        ],
        [
            'text' => 'Tipos de Emails',
            'route' => 'web.admin.email_types.index',
            'icon' => 'fas fa-envelope-open-text', // Remete a correspondência/e-mail
            'can' => 'list,App\\Models\\EmailType',
        ],
        [
            'text' => 'Tipos de Telefones',
            'route' => 'web.admin.phone_types.index',
            'icon' => 'fas fa-phone-square-alt', // Remete a telefonia
            'can' => 'list,App\\Models\\PhoneType',
        ],

        ['header' => 'CONFIGURAÇÕES'],
        [
            'text' => 'Usuários',
            'route' => 'web.admin.users.index',
            'icon' => 'fas fa-users',
            'can' => 'list,App\\Models\\User',
        ],
        [
            'text' => 'Roles',
            'route' => 'web.admin.roles.index',
            'icon' => 'fas fa-user-tag',
            'can' => 'list,App\\Models\\Role',
        ],
    ];