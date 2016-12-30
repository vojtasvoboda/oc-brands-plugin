<?php namespace VojtaSvoboda\Brands\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Brands Back-end Controller
 */
class Brands extends Controller
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
        'vojtasvoboda.brands.brands',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VojtaSvoboda.Brands', 'brands', 'brands');
    }
}
