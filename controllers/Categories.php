<?php namespace VojtaSvoboda\Brands\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\ReorderController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'vojtasvoboda.brands.categories',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VojtaSvoboda.Brands', 'brands', 'categories');
    }

    public function listOverrideColumnValue($record, $columnName, $definition = null)
    {
        if ($columnName == 'brands_count') {
            $link = Backend::url('vojtasvoboda/brands/brands?category=' . $record->id);

            return '<a class="btn btn-xs btn-primary" href="' . $link . '">' . $record->brands_count . '</a>';
        }
    }
}
