<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator;

use Pyrobyte\SitemapGenerator\Contracts\SerializerInterface;
use Pyrobyte\SitemapGenerator\Exceptions\FileWriteException;
use Pyrobyte\SitemapGenerator\Exceptions\InvalidDataException;
use Pyrobyte\SitemapGenerator\Exceptions\UnsupportedFormatException;
use Pyrobyte\SitemapGenerator\Serializers\XmlSerializer;
use Pyrobyte\SitemapGenerator\Serializers\CsvSerializer;
use Pyrobyte\SitemapGenerator\Serializers\JsonSerializer;

/**
 * Класс генератора карты сайта
 */
class SitemapGenerator
{
    protected array $pages;
    protected string $filePath;
    protected SerializerInterface $serializer;

    /**
     * @param array $pages
     * @param string $format
     * @param string $filePath
     * @throws InvalidDataException
     * @throws UnsupportedFormatException
     */
    public function __construct(array $pages, string $format, string $filePath)
    {
        $this->validate($pages);
        $this->pages = $pages;
        $this->filePath = $filePath;
        $this->serializer = match (strtolower($format)) {
            'xml' => new XmlSerializer(),
            'csv' => new CsvSerializer(),
            'json' => new JsonSerializer(),
            default => throw new UnsupportedFormatException("Формат {$format} не поддерживается."),
        };
    }

    /**
     * Генерирует файл карты сайта
     *
     * @throws FileWriteException
     */
    public function generate(): void
    {
        $content = $this->serializer->serialize($this->pages);
        $directory = dirname($this->filePath);

        if (!is_dir($directory) && !mkdir($directory, 0777, true)) {
            throw new FileWriteException("Не удалось создать директорию: $directory");
        }

        if (file_put_contents($this->filePath, $content) === false) {
            throw new FileWriteException("Не удалось записать файл: {$this->filePath}");
        }
    }

    /**
     * Проверка входных данных на корректность
     */
    protected function validate(array $pages): void
    {
        foreach ($pages as $page) {
            if (!isset($page['loc'], $page['lastmod'], $page['priority'], $page['changefreq'])) {
                throw new InvalidDataException('Каждая страница должна содержать loc, lastmod, priority, changefreq');
            }
        }
    }
}
