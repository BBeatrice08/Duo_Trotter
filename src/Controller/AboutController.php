<?php

namespace App\Controller;

class AboutController extends AbstractController
{
    // To give "destinations" and "thèmes" from database in home menu
    public function index():string
    {
        return $this->twig->render('Home/about.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
