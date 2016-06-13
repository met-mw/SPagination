[![Build Status](https://travis-ci.org/met-mw/SPagination.svg?branch=master)](https://travis-ci.org/met-mw/SPagination)
[![Coverage Status](https://coveralls.io/repos/github/met-mw/SPagination/badge.svg?branch=master)](https://coveralls.io/github/met-mw/SPagination?branch=master)
[![Latest Stable Version](https://poser.pugx.org/met_mw/spagination/v/stable)](https://packagist.org/packages/met_mw/spagination)
[![Latest Unstable Version](https://poser.pugx.org/met_mw/spagination/v/unstable)](https://packagist.org/packages/met_mw/spagination)
[![Total Downloads](https://poser.pugx.org/met_mw/spagination/downloads)](https://packagist.org/packages/met_mw/spagination)
[![License](https://poser.pugx.org/met_mw/spagination/license)](https://packagist.org/packages/met_mw/spagination)
# SPagination
Простой механизм постраничной навигации

## Установка
composer require met_mw/spagination

## Пример использования

```PHP
$Pagination = new Pagination();
$Pagination->setCount(100)
    ->setCountOnPage(10)
    ->setCurrentPageNumber(5)
    ->render();
```

## Лицензия
SPagination пакет с открытым исходным кодом, под лицензией **[MIT](https://opensource.org/licenses/MIT)**
