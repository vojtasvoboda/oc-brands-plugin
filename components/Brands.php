<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Request;
use VojtaSvoboda\Brands\Models\Brand;
use VojtaSvoboda\Brands\Models\Category;

class Brands extends ComponentBase
{
    /** @var \Illuminate\Pagination\LengthAwarePaginator $brands A collection of items to display. */
    public $brands;

    /** @var string $pagePath Full page URL. */
    public $pagePath;

    /** @var Category $category */
    public $category;

    /** @var string $letter */
    public $letter;

    /** @var string $detailPage Reference to the page name for linking to brand detail. */
    public $brandPage;

    /** @var string $categoryPage Reference to the page name for linking to categories. */
    public $categoryPage;

    /** @var string $logoWidth */
    public $logoWidth;

    /** @var string $logoHeight */
    public $logoHeight;

    /** @var int $columnSize */
    public $columnSize;

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
            'brandPage' => [
                'title' => 'Brand page',
                'description' => 'Page for showing brand detail',
                'type' => 'dropdown',
                'default' => 'brand-detail',
            ],
            'categoryPage' => [
                'title' => 'Category page',
                'description' => 'Page for showing brand category',
                'type' => 'dropdown',
                'default' => 'brands',
            ],
            'categoryFilter' => [
                'title' => 'Category slug',
                'description' => 'Show only brands from some category',
                'type' => 'string',
                'default' => '{{ :category }}',
                'group' => 'Category',
            ],
            'letterFilter' => [
                'title' => 'Starts with letter',
                'description' => 'Show only brands starts with this letter',
                'type' => 'string',
                'default' => '{{ :letter }}',
                'group' => 'Letter',
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
                'title' => 'Sort order',
                'description' => 'If brands will be rendered ascendent or descendent',
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
        // category filter
        if ($category = $this->property('categoryFilter')) {
            $this->category = $this->getCategory($category);
        }
        $this->page['category'] = $this->category;

        // letter filter
        $this->page['letter'] = $this->letter = $this->property('letterFilter');

        // page links
        $this->brandPage = $this->page['brandPage'] = $this->property('brandPage');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');

        // brands vars
        $this->brands = $this->page['brands'] = $this->listItems();
        $this->pagePath = $this->page['pagePath'] = Request::path();
        $this->columnSize = 12 / $this->property('perRow');
        $this->logoWidth = $this->property('logoWidth');
        $this->logoHeight = $this->property('logoHeight');
    }

    /**
     * Get all brands with pagination.
     *
     * @return mixed
     */
    protected function listItems()
    {
        $parameters = [
            'page' => $this->property('pageNumber'),
            'perPage' => $this->property('perPage'),
            'sortOrder' => $this->property('sortOrder'),
        ];

        if ($this->category) {
            $parameters['category'] = $this->category;
        }

        if ($this->letter) {
            $parameters['letter'] = $this->letter;
        }

        $items = Brand::listFrontEnd($parameters);

        return $this->addLinksTo($items);
    }

    /**
     * Add links to brands.
     *
     * @param $items
     *
     * @return array
     */
    protected function addLinksTo($items)
    {
        $detailPage = $this->brandPage;
        $categoryPage = $this->categoryPage;

        $items->each(function ($item) use ($detailPage, $categoryPage)
        {
            if ($item->no_link) {
                $item->url = null;
            } elseif ($item->external_link) {
                $item->url = $item->external_link;
            } else {
                $item->url = $this->controller->pageUrl($detailPage, [
                    'slug' => $item->slug,
                ]);
            }

            $item->categories->each(function($category) use ($categoryPage) {
                $category->url = $this->controller->pageUrl($categoryPage, [
                    'category' => $category->slug,
                ]);
            });
        });

        return $items;
    }

    /**
     * Get category by slug.
     *
     * @param $category
     *
     * @return mixed
     */
    public function getCategory($category)
    {
        return Category::where('slug', $category)->first();
    }

    /**
     * Get options for the dropdown where the link to the brand page can be selected.
     *
     * @return array
     */
    public function getBrandPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Get options for the dropdown whre the link to the category page can be selected.
     *
     * @return mixed
     */
    public function getCategoryPageOptions()
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
