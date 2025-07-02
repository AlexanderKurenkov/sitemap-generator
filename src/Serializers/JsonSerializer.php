<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator\Serializers;

use Pyrobyte\SitemapGenerator\Contracts\SerializerInterface;

/**
 * Сериализует данные в формат JSON
 */
class JsonSerializer implements SerializerInterface
{
    public function serialize(array $pages): string
    {
        return json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
