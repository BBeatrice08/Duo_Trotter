<?php


namespace App\Model;

class ResultsManager extends AbstractManager
{

    const TABLE = "articles";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function searchArticle(string $search) : array
    {
        $statement = $this->pdo->query("SELECT * FROM articles WHERE title LIKE '%. $search . %'");
        return $statement->fetchAll();
    }
}
