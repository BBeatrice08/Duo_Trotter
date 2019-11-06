<?php

namespace App\Controller;

use App\Model\CountriesManager;

class CountriesController extends AbstractController
{
    public function list($id)
    {
        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectAllByContinents($id);
        return $this->twig->render("Countries/list.html.twig", [
            "countries" => $countries,
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
