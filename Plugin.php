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
     * Plugin details.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'vojtasvoboda.brands::lang.plugin.name',
            'description' => 'vojtasvoboda.brands::lang.plugin.description',
            'author'      => 'Vojta Svoboda',
            'icon'        => 'icon-tags',
            'homepage'    => 'https://github.com/vojtasvoboda/oc-brands-plugin',
        ];
    }

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
                    ],
                    'categories' => [
                        'permissions' => ['vojtasvoboda.brands.categories'],
                        'label' => 'vojtasvoboda.brands::lang.navigation.sideMenu.categories',
                        'icon' => 'icon-folder',
                        'url' => Backend::url('vojtasvoboda/brands/categories'),
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
        ];
    }
}
