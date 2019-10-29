<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    const TABLE = "articles";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function list(/*array $articles*/)
    {

        $request = $this->pdo->prepare("SELECT * FROM ".self::TABLE);

        /*
        $request->bindValue(":title", $article["article_title"], \PDO::PARAM_STR);

        $request->bindValue(":image", $article["article_image"], \PDO::PARAM_STR);
        $request->bindValue(":date", $article["article_date"], \PDO::PARAM_STR);
        $request->bindValue(":content", $article["article_content"], \PDO::PARAM_STR);
        */
        return $request->execute();
    }
}
