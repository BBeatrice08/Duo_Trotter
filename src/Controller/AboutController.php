<?php

namespace App\Controller;

class AboutController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Home/about.html.twig', [
                "categories" => $this->categoriesList(),
                "continents" => $this->continentsList(),
            ]);
    }
}
