[![Build Status](https://travis-ci.org/met-mw/SPagination.svg?branch=master)](https://travis-ci.org/met-mw/SPagination)
[![Coverage Status](https://coveralls.io/repos/github/met-mw/SPagination/badge.svg?branch=master)](https://coveralls.io/github/met-mw/SPagination?branch=master)
[![Latest Stable Version](https://poser.pugx.org/met_mw/spagination/v/stable)](https://packagist.org/packages/met_mw/spagination)
[![Latest Unstable Version](https://poser.pugx.org/met_mw/spagination/v/unstable)](https://packagist.org/packages/met_mw/spagination)
[![Total Downloads](https://poser.pugx.org/met_mw/spagination/downloads)](https://packagist.org/packages/met_mw/spagination)
[![License](https://poser.pugx.org/met_mw/spagination/license)](https://packagist.org/packages/met_mw/spagination)
# SPagination
Simple independent library to create pagination in web-applications.

## Install
composer require met_mw/spagination

## Examples

#### Render

```PHP
$Pagination = new Pagination();
$Pagination->setCount(100)
    ->setCountOnPage(10)
    ->setCurrentPageNumber(5)
    ->render();
```

#### Get as string

```PHP
$Pagination = new Pagination();
$paginationHTML = $Pagination->setCount(100)
    ->setCountOnPage(10)
    ->setCurrentPageNumber(5)
    ->get();
```

## License
The met-mw/SPagination package is open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**
