<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator\Serializers;

use Pyrobyte\SitemapGenerator\Contracts\SerializerInterface;

/**
 * Сериализует данные в формат CSV
 */
class CsvSerializer implements SerializerInterface
{
    public function serialize(array $pages): string
    {
        $output = "loc;lastmod;priority;changefreq\n";

        foreach ($pages as $page) {
            $line = implode(';', [
                $page['loc'],
                $page['lastmod'],
                $page['priority'],
                $page['changefreq'],
            ]);
            $output .= $line . "\n";
        }

        return $output;
    }
}
