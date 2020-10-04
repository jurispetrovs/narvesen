<?php

class ProductFormatter
{
    public static function idFormatter(int $id): string
    {
        return '[' . $id . ']';
    }

    public static function priceFormatter(int $price): string
    {
        return '$' . number_format($price / 100, 2, ',', '.');
    }

    public static function countFormatter(int $amount): string
    {
        return '(' . $amount . ') pieces available';
    }
}