<?php

class Product
{
    private int $id;
    private string $name;
    private int $price;
    private int $count;

    public function __construct(
        int $id,
        string $name,
        int $price,
        int $count
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function removeCount(): int
    {
        return $this->count -= 1;
    }
}