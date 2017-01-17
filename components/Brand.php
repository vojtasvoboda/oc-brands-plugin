<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use VojtaSvoboda\Brands\Models\Brand as Model;

class Brand extends ComponentBase
{
    /** @var Model $item */
    public $item;

    /** @var string $categoryPage Reference to the page name for linking to categories. */
    public $categoryPage;

    public function componentDetails()
    {
        return [
            'name' => 'Brand detail',
            'description' => 'Show brand detail',
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Brand slug',
                'description' => 'Slug for display one particular brand',
                'type' => 'string',
                'default' => '{{ :slug }}',
            ],
            'categoryPage' => [
                'title' => 'Category page',
                'description' => 'Page for showing brand category',
                'type' => 'dropdown',
                'default' => 'brands',
            ],
        ];
    }

    public function onRun()
    {
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->item = $this->page['item'] = $this->getItem();
    }

    protected function getItem()
    {
        $slug = $this->property('slug');
        $item = Model::where('slug', $slug)->isEnabled()->first();
        $categoryPage = $this->categoryPage;

        if ($item) {
            $item->categories->each(function($category) use ($categoryPage) {
                $category->url = $this->controller->pageUrl($categoryPage, [
                    'category' => $category->slug,
                ]);
            });
        }

        return $item;
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
}
