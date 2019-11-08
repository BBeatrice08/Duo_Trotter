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

    public function show($id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectOneById($id);
        return $this->twig->render("Articles/show.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function showByCountry($id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByCountry($id);
        return $this->twig->render("Articles/show_by_country.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function showByCategory($id): string
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAllByCategory($id);
        return $this->twig->render("Articles/show_by_category.html.twig", [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
