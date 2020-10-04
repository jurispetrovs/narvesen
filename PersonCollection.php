<?php


class PersonCollection
{
    private array $persons = [];

    public function __construct(array $persons = [])
    {
        foreach ($persons as $person) {
            $this->addPerson($person);
        }
    }

    public function addPerson(Person $person)
    {
        $this->persons[] = $person;
    }

    public function getAllPersons()
    {
        return $this->persons;
    }

    public function getPersonById(int $id): ?Person
    {
        foreach ($this->getAllPersons() as $person) {
            if ($person->getId() === $id) {

                return $person;
            }
        }
        return null;
    }
}
