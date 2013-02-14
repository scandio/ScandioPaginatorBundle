ScandioPaginatorBundle
======================

A simple pagination bundle for Symfony2 without the fuzz.

## Requirements:

- Symfony2 **>=2.1.0**
- Twig **>=1.5** version

## Installation

Install via composer.json:

    ...
    "repositories": [
            {
                "type": "git",
                "url": "https://github.com/scandio/ScandioPaginatorBundle.git"
            }
        ],
    ...
     "require": {
            ...
            "scandio/paginator-bundle": "dev-master"
            ...
        },


If you use a `deps` file, add:

    [ScandioPaginatorBundle]
        git=http://github.com/scandio/ScandioPaginatorBundle.git
        target=bundles/Scandio/PaginatorBundle

Or if you want to clone the repos:

    # Install Paginator
    git clone git://github.com/scandio/ScandioPaginatorBundle.git vendor/bundles/Scandio/PaginatorBundle

## Usage

You have to build your own database function! This is **NOT** a doctrine query paginator! Use [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) for this.

``` php
<?php
$em = $this->get('doctrine')->getEntityManager();
$paginator = $this->get('scandio.paginator');
$repository = $em->getRepository('...');
$page = $request->get('page', 1);
$limit = 10;

$attributes = $repository->getAll($page, $limit);
$maxCount = $repository->getAllCount();

// fill with data
$paginator->setLimit($limit);
$paginator->setPage($page);
$paginator->setList($attributes);
$paginator->setTotalCount($maxCount);

return array(
	'page' => $page,
	'attributes' => $paginator
);
```

### View

``` html
<ul>
{% for attribute in attributes %}
    <li>{{attribute}}</li>
{% endfor %}
</ul>

{# use pagination link here. Use "page" for pagination index number #}
{{ attributes.paginationBar('attributes_pagination') | raw }}
```

### License

Copyright (c) Scandio <http://https://github.com/scandio/>

This software is under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
