<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator\Contracts;

/**
 * Интерфейс для сериализации карты сайта
 */
interface SerializerInterface
{
    /**
     * Преобразует массив данных в строку для записи в файл
     *
     * @param array $pages
     * @return string
     */
    public function serialize(array $pages): string;
}
