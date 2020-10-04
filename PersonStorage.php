<?php

class PersonStorage
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function loadPersonProducts(string $personProducts): array
    {
        $personProducts = trim($personProducts, "{}");
        $personProducts = (array)array_filter(explode('|', $personProducts));

        return $personProducts;
    }

    public function loadPersons(): array
    {
        $fileContent = file_get_contents($this->path);
        $rows = array_filter((array)explode('/', $fileContent));
        $persons = [];

        foreach ($rows as $row) {
            $personData = (array)explode(';', $row);
            $personProductData = $this->loadPersonProducts($personData[3]);
            $persons[] = new Person(
                (int)$personData[0],
                (string)trim($personData[1]),
                (int)$personData[2],
                (array)$personProductData
            );
        }

        return $persons;
    }

    public function savePersons(string $path, Person $personToSave)
    {
        $fileContent = file($path);
        $lastRow = count($fileContent) - 1;

        $line = array_search($personToSave->getId(), $fileContent);

        $fileContent[$line] = $personToSave->getId() . ';'
            . $personToSave->getName() . ';' . $personToSave->getBudget() . ';{'
            . implode('|', $personToSave->getProducts()) . '}/' . PHP_EOL;

        $fileContent[$lastRow] = str_replace(PHP_EOL, '', $fileContent[$lastRow]);

        file_put_contents($path, $fileContent);
    }
}