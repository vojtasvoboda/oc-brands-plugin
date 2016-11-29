<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use VojtaSvoboda\Brands\Models\Brand as Model;

class Brand extends ComponentBase
{
    public $item;

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
                'default' => '{{ slug }}',
            ],
        ];
    }

    public function onRun()
    {
        $this->item = $this->page['item'] = $this->getItem();
    }

    protected function getItem()
    {
        $slug = $this->property('slug');

        return Model::where('slug', $slug)->isEnabled()->first();
    }
}
