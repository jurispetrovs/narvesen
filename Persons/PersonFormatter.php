<?php

class PersonFormatter
{
    public static function idFormatter(int $id): string
    {
        return '[' . $id . ']';
    }

    public static function budgetFormatter(int $budget): string
    {
        return '$' . number_format($budget / 100, 2, ',', '.');
    }

    public static function productsFormatter(array $products): void
    {
        foreach ($products as $product) {
            echo $product . ' | ';
        }
    }
}