<?php

namespace App\Controller;

use App\Model\CountriesManager;

class CountriesController extends AbstractController
{
    // Show all countries in a continent
    public function show(int $id): string
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
