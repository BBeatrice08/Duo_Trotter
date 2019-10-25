<?php

namespace App\Model;

class ArticlesManager extends AbstractManager
{
    const TABLE = "articles";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertArticle(array $article)
    {
        $request = $this->pdo->prepare(
            "INSERT INTO ".self::TABLE." (title, date, content) VALUES (:title, :date, :content)"
        );
        $request->bindValue(":title", $article["article_title"], \PDO::PARAM_STR);
        $request->bindValue(":date", $article["article_date"], \PDO::PARAM_STR);
        $request->bindValue(":content", $article["article_content"], \PDO::PARAM_STR);
        
        return $request->execute();
    }
}
