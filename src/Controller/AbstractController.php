<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ArticlesManager;
use App\Model\CategoriesManager;
use App\Model\CommentsManager;
use App\Model\ContinentsManager;
use App\Model\CountriesManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 *
 */
abstract class AbstractController
{
    /**
     * @var Environment
     */
    protected $twig;


    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }

    // Allow administrator to log in if user and password are corrects
    public function isLog(): void
    {
        if ($_SESSION['user'] !== ADMIN_LOGIN && $_SESSION['password'] !== ADMIN_PASSWORD) {
            header("Location: /admin/login");
        }
    }
    // To get all the different articles from database
    public function getArticles(): array
    {
        $articlesManager = new articlesManager();
        $articles = $articlesManager->selectAll();
        return $articles;
    }

    public function getCategories():array
    {
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();
        return $categories;
    }

    // To get all the different countries in a alphabetical order
    public function getCountries():array
    {
        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectAllbyAlphabeticalOrder();
        return $countries;
    }

    public function getContinents():array
    {
        $continentsManager = new ContinentsManager();
        $continents = $continentsManager->selectAll();
        return $continents;
    }

    // To get all the comments for each article, one by one
    public function getComments(int $id):array
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAllByArticle($id);
        return $comments;
    }
}
