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
            'text' => 'Tipo de Endereço',
            'route' => 'web.admin.address_types.index',
            'icon' => 'fas fa-users',
            'can' => 'list,App\\Models\\AddressType',
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