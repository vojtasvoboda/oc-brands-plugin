<?php namespace VojtaSvoboda\Brands\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeletingTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Brand extends Model
{
    use SoftDeletingTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'vojtasvoboda_brands_brands';

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|unique:vojtasvoboda_brands_brands',
        'enabled' => 'boolean',
        'description' => 'max:10000',
    ];

    public $translatable = ['name', 'slug', 'description'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attachOne = [
        'logo' => ['System\Models\File'],
    ];

    public $attachMany = [
        'images' => ['System\Models\File'],
    ];

    public $belongsToMany = [
        'categories' => [
            'VojtaSvoboda\Brands\Models\Category',
            'table' => 'vojtasvoboda_brands_brand_category',
            'order' => 'name asc',
            'scope' => 'isEnabled',
            'timestamps' => true,
        ]
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }

    /**
     * Lists brands for the front end.
     *
     * @param \October\Rain\Database\Builder $query
     * @param array $options Display options
     *
     * @return self
     */
    public function scopeListFrontEnd($query, $options)
    {
        // default config
        extract(array_merge([
            'page'       => 1,
            'perPage'    => 10,
            'sort'       => 'sort_order',
            'sortOrder'  => 'ASC',
            'search'     => '',
            'enabled'    => true,
            'category'   => null,
            'letter'     => null,
        ], $options));

        // search by config
        $searchableFields = ['name'];

        // only enabled
        if ($enabled) {
            $query->isEnabled();
        }

        // category filtration
        if ($category instanceof Category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            });
        }

        if ($letter && strlen($letter) == 1) {
            $query
                ->where(function($q) use ($letter) {
                    $q->where('name', 'LIKE', mb_strtolower($letter) . '%')
                        ->orWhere('name', 'LIKE', mb_strtoupper($letter) . '%');
                });
        }

        // order by
        $query->orderBy($sort, $sortOrder);

        // search by
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        return $query->paginate($perPage, $page);
    }
}
