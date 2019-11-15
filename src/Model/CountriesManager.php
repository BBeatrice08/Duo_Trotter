<?php

namespace App\Model;

class CountriesManager extends AbstractManager
{
    const TABLE = "countries";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllByContinent(int $id): array
    {
        // prepared request
        return $this->pdo->query("SELECT * FROM $this->table WHERE continents_id = $id ")->fetchAll();
    }

    public function insertCountry(array $country): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (name, continents_id, image) VALUES 
        (:name, :continents_id, :image)");
        $request->bindValue(":name", $country["country_name"], \PDO::PARAM_STR);
        $request->bindValue(":continents_id", $country["country_continents_id"], \PDO::PARAM_INT);
        $request->bindValue(":image", $country["country_image"], \PDO::PARAM_STR);

        return $request->execute();
    }
}
