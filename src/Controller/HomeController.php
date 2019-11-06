<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ArticlesManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectAll();
        return $this->twig->render('Articles/list.html.twig', [
            "articles" => $articles,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
