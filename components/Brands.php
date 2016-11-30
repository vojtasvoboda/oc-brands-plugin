<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
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
            'detailPage' => [
                'title' => 'Detail page',
                'description' => 'Page for showing brand detail',
                'type' => 'dropdown',
                'default' => 'brand-detail',
            ],
            'perPage' => [
                'title' => 'Brands per page',
                'description' => 'How many brands show at one page',
                'type' => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Per page should be numeric value',
                'default' => 24,
                'group' => 'Paginator',
            ],
            'sortOrder' => [
                'title' => 'Brand order',
                'description' => 'If brand will be rendered ascendent or descendent.',
                'type' => 'dropdown',
                'default' => 'ASC',
                'group' => 'Paginator',
            ],
            'pageNumber' => [
                'title' => 'Page number',
                'description' => 'Which page should be displayed',
                'type' => 'string',
                'default' => '{{ page }}',
                'group' => 'Paginator',
            ],
            'perRow' => [
                'title' => 'Brands per row (1-12)',
                'description' => 'How many brands show in one row',
                'type' => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Per row should be numeric value between 1 and 12',
                'default' => 6,
                'group' => 'Layout',
            ],
            'logoWidth' => [
                'title' => 'Logo width',
                'description' => 'Width of the logo in pixels',
                'type' => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Logo width should be numeric value',
                'default' => 300,
                'group' => 'Layout',
            ],
            'logoHeight' => [
                'title' => 'Logo height',
                'description' => 'Height of the logo in pixels',
                'type' => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Logo height should be numeric value',
                'default' => 300,
                'group' => 'Layout',
            ],
        ];
    }

    public function onRun()
    {
        $this->brands = $this->page['brands'] = $this->listItems();
        $this->pagePath = $this->page['pagePath'] = Request::path();
        $this->page['columnSize'] = 12 / $this->property('perRow');
        $this->page['logoWidth'] = $this->property('logoWidth');
        $this->page['logoHeight'] = $this->property('logoHeight');
    }

    /**
     * Get all brands with pagination.
     *
     * @return mixed
     */
    protected function listItems()
    {
        $items = Brand::listFrontEnd([
            'page' => $this->property('pageNumber'),
            'perPage' => $this->property('perPage'),
            'sortOrder' => $this->property('sortOrder'),
        ]);

        return $this->getDetailPageUrl($items);
    }

    /**
     * Add URL heading to brand detail for each brand.
     *
     * @param $items
     *
     * @return mixed
     */
    protected function getDetailPageUrl($items)
    {
        $detailPage = $this->property('detailPage');

        $items->each(function ($item) use ($detailPage) {
            $item->url = $this->controller->pageUrl($detailPage, [
                'slug' => $item->slug,
            ]);
        });

        return $items;
    }

    /**
     * Get options for the dropdown where the link to the item page can be selected.
     *
     * @return array
     */
    public function getDetailPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Get options for the dropdown selecting brand's list ordering method.
     *
     * @return array
     */
    public function getSortOrderOptions()
    {
        return [
            'ASC' => 'Ascending',
            'DESC' => 'Descending',
        ];
    }
}
