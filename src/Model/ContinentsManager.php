<?php

namespace App\Model;

class ContinentsManager extends AbstractManager
{
    const TABLE = "continents";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
