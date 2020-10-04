<?php

class DrawInformation
{
    public static function drawMenu(): void
    {
        echo PHP_EOL;
        echo '1. See the products' . PHP_EOL;
        echo '2. See the buyers' . PHP_EOL;
        echo '3. Go shopping' . PHP_EOL;
        echo '4. Exit' . PHP_EOL . PHP_EOL;
    }

    public static function drawProducts(Shop $shop): void
    {
        echo PHP_EOL;

        foreach ($shop->getAllProducts() as $product) {
            /** @var Product $product */
            echo ProductFormatter::idFormatter($product->getId()) . ' | ';
            echo $product->getName() . ' | ';
            echo ProductFormatter::priceFormatter($product->getPrice()) . ' | ';
            echo ProductFormatter::countFormatter($product->getCount());
            echo PHP_EOL;
        }
    }

    public static function drawPersons(PersonCollection $personCollection): void
    {
        echo PHP_EOL;

        foreach ($personCollection->getAllPersons() as $person) {
            /** @var Person $person */
            echo PersonFormatter::idFormatter($person->getId()) . ' | ';
            echo $person->getName() . ' | ';
            echo PersonFormatter::budgetFormatter($person->getBudget()) . ' | ';
            PersonFormatter::productsFormatter($person->getProducts());
            echo PHP_EOL;
        }
    }
}