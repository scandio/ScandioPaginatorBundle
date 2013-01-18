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


