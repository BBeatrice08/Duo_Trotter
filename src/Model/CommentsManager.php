<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    const TABLE = "comments";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertComment(array $comments): bool
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (user_name, date, content, articles_id) VALUES
        (:user_name, NOW(), :content, :article_id)");
        $request->bindValue(":user_name", $comments["comment_user_name"], \PDO::PARAM_STR);
        $request->bindValue(":content", $comments["comment_content"], \PDO::PARAM_STR);
        $request->bindValue(":article_id", $comments["comment_article_id"], \PDO::PARAM_INT);

        return $request->execute();
    }
}
