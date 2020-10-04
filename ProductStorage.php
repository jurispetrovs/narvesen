<?php

class ProductStorage
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function loadProducts(): array
    {
        $fileContent = file_get_contents($this->path);
        $rows = array_filter((array)explode('/', $fileContent));
        $products = [];

        foreach ($rows as $row) {
            $productData = (array)explode(';', $row);

            $products[] = new Product(
                (int)$productData[0],
                (string)trim($productData[1]),
                (int)$productData[2],
                (int)$productData[3]
            );
        }
        return $products;
    }

    public function saveProducts(string $path, Product $productToSave): void
    {
        $fileContent = file($path);
        $lastRow = count($fileContent) - 1;

        $line = array_search($productToSave->getId(), $fileContent);

        $fileContent[$line] = $productToSave->getId() . ';'
            . $productToSave->getName() . ';' . $productToSave->getPrice() . ';'
            . $productToSave->getCount() . '/' . PHP_EOL;
        $fileContent[$lastRow] = str_replace(PHP_EOL, '', $fileContent[$lastRow]);

        file_put_contents($path, $fileContent);
    }
}