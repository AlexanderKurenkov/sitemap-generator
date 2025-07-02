<?php

declare(strict_types=1);

namespace Pyrobyte\SitemapGenerator\Contracts;

/**
 * Интерфейс для генерации карты сайта
 */
interface GeneratorInterface
{
    /**
     * Преобразует массив данных в строку для записи в файл
     *
     * @param array $pages
     * @return string
     */
    public function generate(array $pages): string;
}
