<?php

namespace App\Controller;

class AboutController extends AbstractController
{
    public function index():string
    {
        return $this->twig->render('Home/about.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
