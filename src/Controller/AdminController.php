<?php


namespace App\Controller;

use App\Model\AdminManager;
use App\Model\ArticlesManager;

class AdminController extends AbstractController
{
    public function articlesList(): string
    {
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("Admin/articles_list.html.twig", [
            "articles" => $articles,
        ]);
    }

    public function articlesadd()
    {
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
                    header("Location:/Admin/articlesList");
                }
            }
        }
        return $this->twig->render("Admin/articles_add.html.twig");
    }

    /*
    public function articlesEdit(): string
    {
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("Admin/articles_edit.html.twig");
    }
    **
    /**
    public function articlesDelete(): string
    {

    }
    **/
}
