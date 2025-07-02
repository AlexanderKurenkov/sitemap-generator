# Генератор карты сайта в форматах XML, CSV и JSON.

## Установка
```bash
composer require pyrobyte/sitemap-generator
````

## Пример использования

```php
use Pyrobyte\SitemapGenerator\SitemapGenerator;

$generator = new SitemapGenerator($pages, 'xml', __DIR__ . 'sitemap.xml');
$generator->generate();
```

## Поддерживаемые форматы

* xml
* csv
* json
