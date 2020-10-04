<?php

class Person
{
    private int $id;
    private string $name;
    private int $budget;
    private array $products;

    public function __construct(int $id, string $name, int $budget, array $products = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->budget = $budget;
        $this->products = $products;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBudget(): int
    {
        return $this->budget;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addProduct(string $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProduct(): void
    {
        foreach ($this->products as $product) {
            echo $product;
        }
    }

    public function removeMoney(int $amount): void
    {
        $this->budget -= $amount;
    }
}