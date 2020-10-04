<?php

class Shop
{
    private string $name;

    private array $products = [];

    public function __construct(string $name, array $products = [])
    {
        $this->name = $name;

        foreach ($products as $product) {
            $this->addProduct($product);
        }
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getAllProducts(): array
    {
        return $this->products;
    }

    public function getProductById(int $id): ?Product
    {
        foreach ($this->getAllProducts() as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        return null;
    }

    public function checkProductCount(int $id): ?Product
    {
        if ($this->getProductById($id) !== null) {
            if ($this->getProductById($id)->getCount() > 0) {
                return $this->getProductById($id);
            }
        }
        return null;
    }
}