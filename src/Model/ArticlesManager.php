<?php

namespace App\Model;

class ArticlesManager extends AbstractManager
{
    const TABLE = "articles";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Add an new article by giving a title, an image, a date, a content and injected in database in table article.
     * New IDs are automatically create in article table
     */
    public function insertArticle(array $article): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." 
        (title, image,  date, content, categories_id, countries_id) VALUES 
        (:title, :image,  :date, :content, :categories_id, :countries_id)");
        $request->bindValue(":title", $article["article_title"], \PDO::PARAM_STR);
        $request->bindValue(":date", $article["article_date"], \PDO::PARAM_STR);
        $request->bindValue(":content", $article["article_content"], \PDO::PARAM_STR);
        $request->bindValue(":image", $article["article_image"], \PDO::PARAM_STR);
        $request->bindValue(":categories_id", $article["article_category"], \PDO::PARAM_STR);
        $request->bindValue(":countries_id", $article["article_country"], \PDO::PARAM_STR);
        
        return $request->execute();
    }

    /**
     * Modify an article by ID by changing title, article, date or content and update in database.
    */
    public function updateArticle(array $articles): bool
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title, `date` =:date,`image` = :image,  
        `content` = :content, `categories_id` =:categories_id, `countries_id` = :countries_id WHERE id=:id");
        $statement->bindValue('id', $articles['article_id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $articles['article_title'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $articles["article_image"], \PDO::PARAM_STR);
        $statement->bindValue('date', $articles['article_date'], \PDO::PARAM_STR);
        $statement->bindValue('content', $articles['article_content'], \PDO::PARAM_STR);
        $statement->bindValue('categories_id', $articles['article_category'], \PDO::PARAM_INT);
        $statement->bindValue('countries_id', $articles['article_country'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * Delete an article by ID in table article in database
    */
    public function deleteArticle(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
