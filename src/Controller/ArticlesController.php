<?php

namespace App\Controller;

use App\Model\ArticlesManager;

class ArticlesController extends AbstractController
{
    /**
     * Show all articles
    */
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

    /**
     * Show an article by ID
    */
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

    /**
     *  Show all articles by country by ID
    */
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

    /**
     * Show all articles by category by ID
    */
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
}
