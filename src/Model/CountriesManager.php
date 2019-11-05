<?php

namespace App\Model;

class CountriesManager extends AbstractManager
{
    const TABLE = "countries";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
