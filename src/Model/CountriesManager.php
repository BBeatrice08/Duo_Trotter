<?php

namespace App\Model;

class CountriesManager extends AbstractManager
{
    const TABLE = "countries";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllByContinent($id)
    {
        // prepared request
        return $this->pdo->query("SELECT * FROM $this->table WHERE continents_id = $id ")->fetchAll();
    }
}
