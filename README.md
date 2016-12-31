# Brands plugin for OctoberCMS

[![Codacy](https://img.shields.io/codacy/d74cf67246dc48b48971de7ab928650e.svg)](https://www.codacy.com/app/vojtasvoboda/oc-brands-plugin)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/g/vojtasvoboda/oc-brands-plugin.svg)](https://scrutinizer-ci.com/g/vojtasvoboda/oc-brands-plugin/?branch=master)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/vojtasvoboda/oc-brands-plugin/blob/master/LICENSE)

Show your brands, partners, projects, showcases, portfolio or anything else on your page. No other plugin requirements. 
Tested with latest October CMS build 382.

## Key features

- list of all brands with **pagination**, **category filtration** and **letter filtration**
- customizable **Bootstrap layout** (1-12 columns)
- one brand can be in **many categories**, with logo and **unlimited images**
- show brand detail with a **photo gallery**
- **translations** implemented
- SiteSearch plugin **native support**

## Use cases

- show clients logos with external links (or without)
- show projects for my clients represented by logos (with photogallery at brand detail)
- show partners with cooperation details
- show my portfolio with screenshots

## Create brands page

- create new page
- if you want to filter by brand categories, insert category filter to URL: `/brands/:category?`
- insert Brands component
- pick Brand page (brand detail) and Category page (brands in category)
- if you want to filter by letters, insert Brand letters component

Example of Brands page with category and letter filtration:

```
title = "Brands"
url = "/brands/:category?"
layout = "default"
is_hidden = 0

[brands]
brandPage = "brand-detail"
categoryPage = "brands"
categoryFilter = "{{ :category }}"
perPage = 12
sortOrder = "ASC"
pageNumber = "{{ page }}"
perRow = 6
logoWidth = 300
logoHeight = 300

[letters]
brandsPage = "brands"
==
<h1>
	Brands
	{% if category %} in category {{ category.name }}{% endif %}
	{% if letter %} starts with "{{ letter }}"{% endif %}
</h1>

{% if category %}
<p>
    <a href="{{ 'brands' | page({category: ''}) }}">
        <small>&lt; all categories</small>
    </a>
</p>
{% endif %}

{% component 'letters' %}

{% component 'brands' %}
```

## Create brand detail page

- create new page with URL like that: `/brand/:slug/`
- insert Brand component
- pick Category page (page with Brands)

Example of Brand page:

```
title = "Brand detail"
url = "/brand/:slug/"
layout = "default"
is_hidden = 0

[brand]
slug = "{{ :slug }}"
categoryPage = "brands"
==
{% component 'brand' %}
```

## Brand's links

Each brand can have multiple types of links:

1. Link to brand detail - fill only slug and create brand detail page.
2. External link - fill external link parameter, it will override internal link.
3. No link - shows logo without any link, it will override all links above.

## Extending plugin

I'm using this plugin as example how to build first plugin ever, because it covers managing one entity (create, update, delete, change order), create one relation (brand - category) and render all items at the frontend.

I also created examples, how to easily extend plugin's functionality and put all these example to [Brands extending examples](https://github.com/vojtasvoboda/oc-brands-plugin-override-example) repository.

## TODO

- [ ] fix page title at brand detail
- [ ] changing order for categories
- [ ] batch delete for categories
- [ ] tags management
- [ ] brand detail - paginator for gallery

## Contributing

Please send Pull Request to the master branch. Please add also unit tests and make sure all unit tests are green.

## License

Brands plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.
