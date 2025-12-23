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

        ['header' => 'GESTÃO'],
        [
            'text' => 'Vidas',
            'route' => 'web.admin.lives.index',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-5 w-5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>', // Remete a localização/endereço
            'can' => 'list,App\\Models\\Life',
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
        [
            'text' => 'Tipos de Documentos',
            'route' => 'web.admin.document_types.index',
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