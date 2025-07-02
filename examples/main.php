<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Pyrobyte\SitemapGenerator\SitemapGenerator;

$pages = [
    ['loc' => 'https://site.ru/', 'lastmod' => '2020-12-14', 'priority' => '1', 'changefreq' => 'hourly'],
    ['loc' => 'https://site.ru/news', 'lastmod' => '2020-12-10', 'priority' => '0.5', 'changefreq' => 'daily'],
    ['loc' => 'https://site.ru/about', 'lastmod' => '2020-12-07', 'priority' => '0.1', 'changefreq' => 'weekly'],
    ['loc' => 'https://site.ru/products', 'lastmod' => '2020-12-12', 'priority' => '0.5', 'changefreq' => 'daily'],
    ['loc' => 'https://site.ru/products/ps5', 'lastmod' => '2020-12-11', 'priority' => '0.1', 'changefreq' => 'weekly'],
    ['loc' => 'https://site.ru/products/xbox', 'lastmod' => '2020-12-12', 'priority' => '0.1', 'changefreq' => 'weekly'],
    ['loc' => 'https://site.ru/products/wii', 'lastmod' => '2020-12-11', 'priority' => '0.1', 'changefreq' => 'weekly'],
];

function generate_sitemap(array $pages, string $format, string $output_path): void
{
    try {
        $generator = new SitemapGenerator($pages, $format, $output_path);
        $generator->generate();
        echo "Sitemap успешно создан.\n";
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }
}

generate_sitemap($pages, 'xml', __DIR__ . '/sitemap.xml');
generate_sitemap($pages, 'json', __DIR__ . '/sitemap.json');
generate_sitemap($pages, 'csv', __DIR__ . '/sitemap.csv');
