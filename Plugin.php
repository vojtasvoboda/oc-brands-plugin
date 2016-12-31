<?php namespace VojtaSvoboda\Brands;

use Backend;
use System\Classes\PluginBase;

/**
 * Class Plugin.
 *
 * @package VojtaSvoboda\Brands
 */
class Plugin extends PluginBase
{
    /**
     * Register permissions.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'vojtasvoboda.brands.brands' => [
                'tab'   => 'vojtasvoboda.brands::lang.permissions.tab',
                'label' => 'vojtasvoboda.brands::lang.permissions.manage',
            ],
            'vojtasvoboda.brands.categories' => [
                'tab'   => 'vojtasvoboda.brands::lang.permissions.tab',
                'label' => 'vojtasvoboda.brands::lang.permissions.manage',
            ],
        ];
    }

    /**
     * Register navigation.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'brands' => [
                'label' => 'vojtasvoboda.brands::lang.navigation.label',
                'url' => Backend::url('vojtasvoboda/brands/brands'),
                'icon' => 'icon-tags',
                'permissions' => ['vojtasvoboda.brands.brands'],
                'order' => 500,
                'sideMenu' => [
                    'brands' => [
                        'permissions' => ['vojtasvoboda.brands.brands'],
                        'label' => 'vojtasvoboda.brands::lang.navigation.sideMenu.items',
                        'icon' => 'icon-tags',
                        'url' => Backend::url('vojtasvoboda/brands/brands'),
                        'order' => 100,
                    ],
                    'categories' => [
                        'permissions' => ['vojtasvoboda.brands.categories'],
                        'label' => 'vojtasvoboda.brands::lang.navigation.sideMenu.categories',
                        'icon' => 'icon-folder',
                        'url' => Backend::url('vojtasvoboda/brands/categories'),
                        'order' => 200,
                    ],
                ],
            ],
        ];
    }

    /**
     * Register components.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'VojtaSvoboda\Brands\Components\Brands' => 'brands',
            'VojtaSvoboda\Brands\Components\Brand' => 'brand',
            'VojtaSvoboda\Brands\Components\Letters' => 'letters',
        ];
    }
}
