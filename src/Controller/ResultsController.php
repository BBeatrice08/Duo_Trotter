<?php

namespace App\Controller;

use App\Model\ResultsManager;
use App\Model\ArticlesManager;
use App\Model\AbstractManager;

class ResultsController extends AbstractController
{

    public function research(): string
    {

        if (isset($_POST['search']) and !empty($_POST['search'])) {
            $search = $_POST['search'];
            $resultsManager = new ResultsManager();
            $results = $resultsManager->searchArticle($search);
            $results[] = $search;
            return $this->twig->render("Articles/search_results.html.twig", [
                "results" => $results ,
                "articles" => $this->getArticles()]);
        } else {
            header('Location:/Articles/list');
        }
    }
}
