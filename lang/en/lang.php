<?php

return [
    'plugin' => [
        'name' => 'Brands',
        'description' => 'A plugin that allows you to show off some brands.',
    ],
    'navigation' => [
        'label' => 'Brands',
        'sideMenu' => [
            'items' => 'Brands',
            'categories' => 'Categories',
        ],
    ],
    'permissions' => [
        'tab' => 'Brands',
        'manage_brands' => 'Brands management',
        'manage_categories' => 'Categories management',
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
