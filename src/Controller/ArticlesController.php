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
            "categories" => $this->categoriesList(),
        ]);
    }
}




/*    public function edit(int $id)
    {
        die("edit article number $id");
    }

    public function delete(int $id)
    {
        die("delete article number $id");
    }*/
