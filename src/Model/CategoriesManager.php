<?php

namespace App\Model;

class CategoriesManager extends AbstractManager
{
    const TABLE = "categories";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertCategory(array $category)
    {

        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (name) VALUES 
        (:name)");
        $request->bindValue(":name", $category["category_name"], \PDO::PARAM_STR);

        return $request->execute();
    }
}
