<?php

return [
    'plugin' => [
        'name' => 'Značky',
        'description' => 'Plugin pro zobrazení značek.',
    ],
    'navigation' => [
        'label' => 'Značky',
        'sideMenu' => [
            'items' => 'Značky',
            'categories' => 'Kategorie',
        ],
    ],
    'permissions' => [
        'tab' => 'Značky',
        'manage_brands' => 'Správa značek',
        'manage_categories' => 'Správa kategorií',
    ],
    'labels' => [
        'brand' => [
            'id' => 'ID',
            'name' => 'Název',
            'slug' => 'Slug',
            'categories' => 'Kategorie',
            'sort_order' => 'Pořadí',
            'enabled' => 'Aktivní',
            'images' => 'Obrázky',
            'logo' => 'Logo',
            'gallery' => 'Galerie',
            'description' => 'Popis',
            'links' => 'Odkazy',
            'external_link' => 'Externí URL',
            'external_link_comment' => 'Přetíží interní odkaz',
            'no_link' => 'Bez odkazu',
            'no_link_comment' => 'Logo se zobrazí bez jakéhokoli odkazu',
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Název',
            'slug' => 'Slug',
            'sort_order' => 'Pořadí',
            'description' => 'Popis',
            'enabled' => 'Aktivní',
        ],
    ],
];
