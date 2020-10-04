<?php

require_once 'Products/Product.php';
require_once 'Products/Shop.php';
require_once 'Products/ProductStorage.php';
require_once 'Products/ProductFormatter.php';

require_once 'Persons/Person.php';
require_once 'Persons/PersonCollection.php';
require_once 'Persons/PersonStorage.php';
require_once 'Persons/PersonFormatter.php';

require_once 'DrawInformation.php';

require_once 'Shopping.php';

$productStorage = new ProductStorage('./Products/products.txt');
$shop = new Shop('Narvesen Salaspils', $productStorage->loadProducts());

$personStorage = new PersonStorage('./Persons/persons.txt');
$personCollection = new PersonCollection($personStorage->loadPersons());

while (true) {
    DrawInformation::drawMenu();

    $menu = (int)readline('Choose what you want to do [1-4]: ');

    switch ($menu) {
        case 1:
            DrawInformation::drawProducts($shop);
            break;
        case 2:
            DrawInformation::drawPersons($personCollection);
            break;
        case 3:
            $shopping = new Shopping($shop, $productStorage, $personCollection, $personStorage);
            $shopping->buyProduct();
            break;
        case 4:
            echo PHP_EOL . 'Exit' . PHP_EOL;
            return false;
        default:
            echo PHP_EOL . 'Wrong choice. Try again' . PHP_EOL;
            break;
    }
}