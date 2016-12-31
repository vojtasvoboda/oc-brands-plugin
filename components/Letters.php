<?php namespace VojtaSvoboda\Brands\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use VojtaSvoboda\Brands\Models\Brand as Model;

class Letters extends ComponentBase
{
    public $letters;

    public function componentDetails()
    {
        return [
            'name' => 'Brand letters',
            'description' => 'Show all starting letters to filtrate brands.',
        ];
    }

    public function defineProperties()
    {
        return [
            'brandsPage' => [
                'title' => 'Brands page',
                'description' => 'Page for showing brands',
                'type' => 'dropdown',
                'default' => 'brands',
            ],
        ];
    }

    public function onRun()
    {
        $this->page['letters'] = $this->letters = $this->getBrandLetters();
    }

    /**
     * Get sorted list of brand letters.
     *
     * @return array
     */
    public function getBrandLetters()
    {
        // get unique letters
        $letters = [];
        Model::all()->each(function($brand) use (&$letters)
        {
            // get letter
            $letter = mb_strtolower(mb_substr($brand->name, 0, 1));

            // init array when doesn't exists
            if (!isset($letters[$letter])) {
                $letters[$letter] = [
                    'name' => $letter,
                    'count' => 0,
                    'url' => $this->controller->pageUrl($this->property('brandsPage'), [
                        'letter' => $letter,
                    ]),
                ];
            }
            $letters[$letter]['count']++;
        });

        // sort them
        usort($letters, function($a, $b) {
            if ($a['name'] == $b['name']) {
                return 0;
            }

            return $a['name'] > $b['name'] ? 1 : -1;
        });

        return $letters;
    }

    /**
     * Get options for the dropdown where the link to the brand page can be selected.
     *
     * @return array
     */
    public function getBrandsPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }
}
