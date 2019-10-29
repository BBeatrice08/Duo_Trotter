<?php


namespace App\Controller;

use App\Model\AdminManager;

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

 /*
    public function articlesAdd(): string
    {

    }

    public function articlesEdit(): string
    {

    }

    public function articlesDelete(): string
    {

    }
 */

}
