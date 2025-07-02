<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator\Serializers;

use Pyrobyte\SitemapGenerator\Contracts\SerializerInterface;

/**
 * Сериализует данные в формат XML
 */
class XmlSerializer implements SerializerInterface
{
    public function serialize(array $pages): string
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        foreach ($pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($page['loc']));
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }

        return $xml->asXML();
    }
}
