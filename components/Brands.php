<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use Request;
use VojtaSvoboda\Brands\Models\Brand;

class Brands extends ComponentBase
{
    /** @var \Illuminate\Pagination\LengthAwarePaginator $brands A collection of items to display. */
    public $brands;

    /** @var string $pagePath Full page URL. */
    public $pagePath;

    public function componentDetails()
    {
        return [
            'name' => 'Brands',
            'description' => 'Show all brands paginated',
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title' => 'Page number',
                'description' => 'Which page should be displayed',
                'type' => 'string',
                'default' => '{{ page }}',
            ],
            'perPage' => [
                'title' => 'Brands per page',
                'description' => 'How many brands show at one page',
                'type' => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Per page should be numeric value',
                'default' => 24,
            ],
        ];
    }

    public function onRun()
    {
        $this->brands = $this->page['brands'] = $this->listItems();
        $this->pagePath = $this->page['pagePath'] = Request::path();
    }

    protected function listItems()
    {
        $items = Brand::listFrontEnd([
            'page' => $this->property('pageNumber'),
            'perPage' => $this->property('perPage'),
        ]);

        return $items;
    }
}
