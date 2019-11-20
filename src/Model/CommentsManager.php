<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    const TABLE = "comments";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Get all comments by article by ID from database
    */
    public function listComment(): array
    {
        $request = $this->pdo->prepare("
        SELECT c.id, c.date, c.user_name, c.content, a.title
        FROM ".self::TABLE." c
            JOIN ".ArticlesManager::TABLE." a ON c.articles_id = a.id
            ORDER BY a.id DESC
        ");

        $request->execute();

        return $request->fetchAll();
    }

    /**
     * Add a new comment in table comment in database by giving a user_name and a content.
    */
    public function insertComment(array $comments): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (user_name, date, content, articles_id) VALUES
        (:user_name, NOW(), :content, :article_id)");
        $request->bindValue(":user_name", $comments["comment_user_name"], \PDO::PARAM_STR);
        $request->bindValue(":content", $comments["comment_content"], \PDO::PARAM_STR);
        $request->bindValue(":article_id", $comments["comment_article_id"], \PDO::PARAM_INT);

        return $request->execute();
    }

    /**
     * Delete a comment by ID in table comments in database
    */
    public function deleteComments(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM ".self::TABLE." WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
