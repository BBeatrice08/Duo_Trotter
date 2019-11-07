<?php

namespace App\Controller;

use App\Model\CountriesManager;

class CountriesController extends AbstractController
{
    public function show($id)
    {
        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectAllByContinent($id);
        return $this->twig->render("Countries/show.html.twig", [
            "countries" => $countries,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
