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
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (user_name, date, content) VALUES
        (:user_name, :date, :content)");
        $request->bindValue(":user_name", $comments["comment_user_name"], \PDO::PARAM_STR);
        $request->bindValue(":date", $comments["comment_date"], \PDO::PARAM_STR);
        $request->bindValue(":content", $comments["comment_content"], \PDO::PARAM_STR);

        return $request->execute();
    }
}
