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
            'name' => 'Name',
            'slug' => 'Slug',
            'categories' => 'Categories',
            'sort_order' => 'Sort order',
            'enabled' => 'Enabled',
            'images' => 'Images',
            'logo' => 'Logo',
            'gallery' => 'Gallery',
            'description' => 'Description',
            'links' => 'Odkazy',
            'external_link' => 'Externí URL',
            'external_link_comment' => 'Přetíží interní odkaz',
            'no_link' => 'Bez odkazu',
            'no_link_comment' => 'Logo se zobrazí bez jakéhokoli odkazu',
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'sort_order' => 'Sort order',
            'description' => 'Description',
            'enabled' => 'Enabled',
        ],
    ],
];
