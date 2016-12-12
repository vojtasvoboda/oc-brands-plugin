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
            'links' => 'Links',
            'external_link' => 'External URL',
            'external_link_comment' => 'Override internal slug parameter',
            'no_link' => 'No link',
            'no_link_comment' => 'Show logo without any link',
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
