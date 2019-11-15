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
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function show(int $id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectOneById($id);
        return $this->twig->render("Articles/show.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
            "comments" => $this->getComments($id),
        ]);
    }

    public function showByCountry(int $id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByCountry($id);
        return $this->twig->render("Articles/show_by_country.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function showByCategory(int $id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByCategory($id);
        return $this->twig->render("Articles/show_by_category.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function research(string $search): string
    {

        if (isset($_POST['search']) and !empty($_POST['search'])) {
            $search = $_POST['search'];
            $articlesManager = new ArticlesManager();
            $articles = $articlesManager->searchArticle($search);
            return $this->twig->render("Articles/results.html.twig", [
                "articles" => $articles]);
        }
    }
}
