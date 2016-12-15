<?php

return [
    'plugin' => [
        'name' => 'Marken',
        'description' => 'Das Plugin ermöglicht das Anzeigen von Marken.',
    ],
    'navigation' => [
        'label' => 'Marken',
        'sideMenu' => [
            'items' => 'Marken',
            'categories' => 'Kategorien',
        ],
    ],
    'permissions' => [
        'tab' => 'Marken',
        'manage_brands' => 'Marken-Verwaltung',
        'manage_categories' => 'Kategorien-Verwaltung',
    ],
    'labels' => [
        'brand' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'categories' => 'Kategorien',
            'sort_order' => 'Reihenfolge',
            'enabled' => 'Aktiviert',
            'images' => 'Bilder',
            'logo' => 'Logo',
            'gallery' => 'Galerie',
            'description' => 'Beschreibung',
            'links' => 'Links',
            'external_link' => 'Externe URL',
            'external_link_comment' => 'Überschreibt den internen Slug-Parameter.',
            'no_link' => 'Kein Link',
            'no_link_comment' => 'Zeigt Logo ohne Verlinkung',
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'sort_order' => 'Reihenfolge',
            'description' => 'Beschreibung',
            'enabled' => 'Aktiviert',
        ],
    ],
];
