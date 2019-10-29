<?php


namespace App\Controller;

use App\Model\ArticlesManager;

class AdminController extends AbstractController
{

    /**
     * Display admin page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function articlesList()
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("Admin/admin_list.html.twig", [
            "articles" => $articles,
        ]);
    }
}
