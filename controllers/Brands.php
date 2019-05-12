<?php namespace VojtaSvoboda\Brands\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Input;
use Session;
use VojtaSvoboda\Brands\Models\Category;

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

        // update filters by GET parameter
        if ($id = Input::get('category')) {
            // get original filtering
            $widgetSession = Session::get('widget');
            $key = 'vojtasvoboda_brands-Brands-Filter-listFilter';

            // create new filter
            $filter['scope-category'] = [
                $id => Category::find($id)->name,
            ];

            // save new filter
            $encoded = base64_encode(serialize($filter));
            $withoutFiltering = !isset($widgetSession[$key]);
            if ($withoutFiltering || $widgetSession[$key] !== $encoded) {
                $widgetSession[$key] = $encoded;
                Session::put('widget', $widgetSession);
            }
        }
    }
}
