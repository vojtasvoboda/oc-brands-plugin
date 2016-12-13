# Brands plugin for OctoberCMS

Show your brands, partners, projects, showcases, portfolio or anything else on your page. No other plugin requirements. 
Tested with latest October CMS build 382.

## Key features

- list of all brands with **pagination**
- customizable **Bootstrap layout**
- one brand can be in many categories, with logo and **unlimited images**
- **filtration** by categories
- show brand detail with a **photo gallery**
- **translations** implemented

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

Example of Brands page with category filtration:

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
==
<h1>Brands {{ category.name }}</h1>

{% if category %}
<p>
    <a href="{{ 'brands' | page({category: ''}) }}">
        <small>&lt; all categories</small>
    </a>
</p>
{% endif %}

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

## TODO

- fix page title at brand detail
- changing order for categories
- batch delete for categories
- tags management
- brand detail - paginator for gallery

## Contributing

Please send Pull Request to the master branch. Please add also unit tests and make sure all unit tests are green.

## License

Brands plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.
