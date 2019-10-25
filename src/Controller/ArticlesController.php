<?php

namespace App\Controller;

use App\Model\ArticlesManager;

class ArticlesController extends AbstractController
{
    public function list(): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("Articles/list.html.twig", [
            "articles" => $articles,
        ]);
    }

    public function add()
    {
        var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["article_title"]) || !isset($_POST["article_title"])) {
                $send = false;
            }
            if (empty($_POST["article_date"]) || !isset($_POST["article_date"])) {
                $send = false;
            }
            if (empty($_POST["article_content"]) || !isset($_POST["article_content"])) {
                $send = false;
            }
            if ($send) {
                $articlesManager = new ArticlesManager();
                if ($articlesManager->insertArticle($_POST)) {
                    header("Location:/articles/list");
                }
            }
        }
        return $this->twig->render("Articles/add.html.twig");
    }

/*    public function edit(int $id)
    {
        die("edit article number $id");
    }

    public function delete(int $id)
    {
        die("delete article number $id");
    }*/
}
