[![Build Status](https://travis-ci.org/met-mw/SPagination.svg?branch=master)](https://travis-ci.org/met-mw/SPagination)
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
