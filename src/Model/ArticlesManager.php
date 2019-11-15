<?php

namespace App\Model;

class ArticlesManager extends AbstractManager
{
    const TABLE = "articles";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertArticle(array $article): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." 
        (title, image, date, content, categories_id, countries_id) VALUES 
        (:title, :image, :date, :content, :categories_id, :countries_id)");
        $request->bindValue(":title", $article["article_title"], \PDO::PARAM_STR);
        $request->bindValue(":image", $article["article_image"], \PDO::PARAM_STR);
        $request->bindValue(":date", $article["article_date"], \PDO::PARAM_STR);
        $request->bindValue(":content", $article["article_content"], \PDO::PARAM_STR);
        $request->bindValue(":categories_id", $article["article_category"], \PDO::PARAM_STR);
        $request->bindValue(":countries_id", $article["article_country"], \PDO::PARAM_STR);
        
        return $request->execute();
    }

    public function updateArticle(array $articles): bool
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title, `image` = :image, `date` =:date, 
        `content` = :content, `categories_id` =:categories_id, `countries_id` = :countries_id WHERE id=:id");
        $statement->bindValue('id', $articles['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $articles['title'], \PDO::PARAM_STR);
        $statement->bindValue('image', $articles['image'], \PDO::PARAM_STR);
        $statement->bindValue('date', $articles['date'], \PDO::PARAM_STR);
        $statement->bindValue('content', $articles['content'], \PDO::PARAM_STR);
        $statement->bindValue('categories_id', $articles['category'], \PDO::PARAM_INT);
        $statement->bindValue('countries_id', $articles['country'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function deleteArticle(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function searchArticle(string $search) : array
    {
        return $this->pdo->query("SELECT * FROM articles WHERE title LIKE % . $search . %")->fetchAll();
    }
}
