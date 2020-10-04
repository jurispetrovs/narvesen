<?php

require_once 'Product.php';
require_once 'Shop.php';
require_once 'ProductStorage.php';
require_once 'ProductFormatter.php';
require_once 'Person.php';
require_once 'PersonStorage.php';
require_once 'PersonCollection.php';
require_once 'PersonFormatter.php';
require_once 'DrawInformation.php';

$productStorage = new ProductStorage('products.txt');
$shop = new Shop('Narvesen Salaspils', $productStorage->loadProducts());

$personStorage = new PersonStorage('persons.txt');
$personCollection = new PersonCollection($personStorage->loadPersons());

function shopping(PersonCollection $personCollection, PersonStorage $personStorage, Shop $shop, ProductStorage $productStorage): void
{
    $buyerId = (int)readline('Please choose a buyer: ');
    $buyer = $personCollection->getPersonById($buyerId);
    if ($buyer !== null) {
        $productId = (int)readline('Please choose a product: ');
        $product = $shop->checkProduct($productId);
        if ($product !== null && $buyer->getBudget() > $product->getPrice()) {
            $product->removeCount();
            $buyer->removeMoney($product->getPrice());
            $buyer->addProduct($product->getName());

            $personStorage->savePersons('persons.txt', $buyer);
            $productStorage->saveProducts('products.txt', $product);
        } elseif($product !== null && $buyer->getBudget() < $product->getPrice()) {
            echo 'Sorry you dont have enough money' . PHP_EOL;
        } else {
            echo 'There is no product with such ID or product are temporary out of stock' . PHP_EOL;
        }
    } else {
        echo 'There is no buyer with such ID' . PHP_EOL;
    }
}

while (true) {
    DrawInformation::drawMenu();

    $menu = (int)readline('Choose what you want to do: ');

    switch ($menu) {
        case 1:
            DrawInformation::drawProducts($shop);
            break;
        case 2:
            DrawInformation::drawPersons($personCollection);
            break;
        case 3:
            DrawInformation::drawPersons($personCollection);
            echo PHP_EOL;
            shopping($personCollection, $personStorage, $shop, $productStorage);
            break;
        case 4:
            echo PHP_EOL . 'Exit' . PHP_EOL;
            return false;
        default:
            echo PHP_EOL . 'Wrong choice. Try again' . PHP_EOL;
            break;
    }
}