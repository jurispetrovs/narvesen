<?php

class Shopping
{
    private int $productId;
    private int $personId;

    private Shop $shop;
    private ProductStorage $productStorage;

    private PersonCollection $personCollection;
    private PersonStorage $personStorage;

    public function __construct(
        Shop $shop,
        ProductStorage $productStorage,
        PersonCollection $personCollection,
        PersonStorage $personStorage,
        int $productId = 0,
        int $personId = 0
    )
    {
        $this->shop = $shop;
        $this->productStorage = $productStorage;
        $this->personCollection = $personCollection;
        $this->personStorage = $personStorage;
        $this->productId = $productId;
        $this->personId = $personId;
    }

    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    public function setPersonId($personId): void
    {
        $this->personId = $personId;
    }

    public function buyProduct(): void
    {
        DrawInformation::drawPersons($this->personCollection);

        $this->setPersonId((int)readline('Please choose a buyer [id]: '));
        $person = $this->personCollection->getPersonById($this->personId);

        if ($person !== null) {
            DrawInformation::drawProducts($this->shop);

            $this->setProductId((int)readline('Please choose a product [id]: '));
            echo PHP_EOL;
            $product = $this->shop->checkProductCount($this->productId);

            if ($product !== null && $person->getBudget() > $product->getPrice()) {
                $product->removeCount();
                $person->removeMoney($product->getPrice());
                $person->addProduct($product->getName());

                $this->personStorage->savePersons($person);
                $this->productStorage->saveProducts($product);

                echo $person->getName() . ', thanks for buying ' . $product->getName() . PHP_EOL . PHP_EOL;

            } elseif ($product !== null && $person->getBudget() < $product->getPrice()) {
                echo 'Sorry you dont have enough money' . PHP_EOL . PHP_EOL;
            } else {
                echo 'There is no product with such ID or product are temporary out of stock' . PHP_EOL . PHP_EOL;
            }
        } else {
            echo 'There is no buyer with such ID' . PHP_EOL . PHP_EOL;
        }
    }
}