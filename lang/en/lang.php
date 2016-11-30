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
    'columns' => [
        'brand' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'categories' => 'Categories',
            'sort_order' => 'Sort order',
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'sort_order' => 'Sort order',
            'description' => 'Description',
        ],
    ],
    'fields' => [
        'brand' => [
            'name' => 'Name',
            'categories' => 'Categories',
            'slug' => 'Slug',
            'description' => 'Description',
            'images' => 'Images',
            'logo' => 'Logo',
            'gallery' => 'Gallery',
        ],
        'category' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
        ],
    ],
];
