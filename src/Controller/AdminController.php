<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function articlesList(): string
    {
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAll();
        return $this->twig->render("Admin/articles_list.html.twig", [
            "articles" => $articles,
        ]);
    }
}
