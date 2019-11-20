<?php

namespace App\Model;

class CategoriesManager extends AbstractManager
{
    const TABLE = "categories";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Insert into the table category in database a new category
    */
    public function insertCategory(array $category): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (name) VALUES 
        (:name)");
        $request->bindValue(":name", $category["category_name"], \PDO::PARAM_STR);

        return $request->execute();
    }

    /**
     * Modify a category by ID in table category in database
    */
    public function update(array $categories):bool
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `name` = :name WHERE id=:id");
        $statement->bindValue('id', $categories['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $categories['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Delete a category by ID in table category in database
    */
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
