# Brands plugin for OctoberCMS

Show your brands, partners, portfolio or anything else on your page. No other plugin requirements. Tested with latest October CMS build 382.

## Key features

- list of brands with pagination
- filtration by categories
- customizable Bootstrap layout
- show brand detail with nice photo gallery
- translations implemented

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

## TODO

- fix page title at brand detail
- changing order for categories
- batch delete for categories
- tags management
- brand detail - paginator for gallery
