<?php

namespace App\Controller;

use App\Model\AdminManager;
use App\Model\ArticlesManager;
use App\Model\CategoriesManager;
use App\Model\CommentsManager;
use App\Model\CountriesManager;

class AdminController extends AbstractController
{

    public function login()
    {
        session_start();
        if (!empty($_POST)) {
            if (isset($_POST['user']) || $_POST['password']) {
                if ($_POST['user'] == 'duotrotter' && $_POST['password'] == 'coucou2019') {
                    $_SESSION['user'] = 'duotrotter';
                    $_SESSION['password'] = 'coucou2019';
                    header('Location: ../admin/articlesList');
                } elseif ($_POST['user'] != 'duotrotter' || $_POST['password'] != 'coucou2019') {
                    header('Location: ../admin/login');
                }
            }
        } else {
            return $this->twig->render("/Admin/login.html.twig");
        }
    }

    public function articlesList(): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("/Admin/articles_list.html.twig", [
            "articles" => $articles,
        ]);
    }

    public function articlesAdd(): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["article_title"]) || !isset($_POST["article_title"])) {
                $send = false;
            }
            if (empty($_POST["article_date"]) || !isset($_POST["article_date"])) {
                $send = false;
            }

            if (empty($_POST["article_content"]) || !isset($_POST["article_content"])) {
                $send = false;
            }
            if ($send) {
                $articlesManager = new ArticlesManager();

                if ($articlesManager->insertArticle($_POST)) {
                    header("Location:/Admin/articlesList");
                }
            }
        }
        return $this->twig->render("/Admin/articles_add.html.twig", [
            "categories" => $this->getCategories(),
            "countries" => $this->getCountries(),
        ]);
    }

    public function articlesEdit(int $id): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $articlesManager = new ArticlesManager();
        $articles = $articlesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $send = true;
            if (empty($_POST["article_title"]) || !isset($_POST["article_title"])) {
                $send = false;
            } else {
                $articles['title'] = $_POST["article_title"];
            }

            if (empty($_POST["article_id"]) || !isset($_POST["article_id"])) {
                $send = false;
            } else {
                $articles['id'] = $_POST["article_id"];
            }

            if (empty($_POST["article_image"]) || !isset($_POST["article_image"])) {
                $send = false;
            } else {
                $articles['image'] = $_POST["article_image"];
            }

            if (empty($_POST["article_date"]) || !isset($_POST["article_date"])) {
                $send = false;
            } else {
                $articles['date'] = $_POST["article_date"];
            }

            if (empty($_POST["article_category"]) || !isset($_POST["article_category"])) {
                $send = false;
            } else {
                $articles['category'] = $_POST["article_category"];
            }

            if (empty($_POST["article_country"]) || !isset($_POST["article_country"])) {
                $send = false;
            } else {
                $articles['country'] = $_POST["article_country"];
            }

            if (empty($_POST["article_content"]) || !isset($_POST["article_content"])) {
                $send = false;
            } else {
                $articles['content'] = $_POST["article_content"];
            }

            $articles['id'] = $_POST["article_id"];

            if ($send) {
                $articlesManager->updateArticle($articles);
                header("Location:/Admin/articlesList");
            }
        }

        return $this->twig->render('Admin/articles_edit.html.twig', ['articles' => $articles,
            "countries" => $this->getCountries(),
            "categories" => $this->getCategories(),
            ]);
    }

    public function articlesDelete(int $id): void
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $articlesManager = new ArticlesManager();
        $articlesManager->deleteArticle($id);
        header('Location:/Admin/articlesList');
    }

    public function categoriesList():string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();
        return $this->twig->render("/Admin/categories_list.html.twig", [
            "categories" => $categories,
        ]);
    }

    public function categoriesAdd(): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["category_name"]) || !isset($_POST["category_name"])) {
                $send = false;
            }
            if ($send) {
                $categoriesManager = new CategoriesManager();

                if ($categoriesManager->insertCategory($_POST)) {
                    header("Location:/Admin/categoriesList");
                }
            }
        }
        return $this->twig->render("/Admin/categories_add.html.twig");
    }

    public function categoriesEdit(int $id): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $send = true;
            if (empty($_POST["category_name"]) || !isset($_POST["category_name"])) {
                $send = false;
            } else {
                $categories['name'] = $_POST["category_name"];
            }

            $categories['id'] = $_POST["category_id"];

            if ($send) {
                $categoriesManager->update($categories);
                header("Location:/Admin/categoriesList");
            }
        }

        return $this->twig->render('/Admin/categories_edit.html.twig', ['categories' => $categories]);
    }

    public function categoriesDelete(int $id): void
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $categoriesManager = new CategoriesManager();
        $categoriesManager->delete($id);
        header('Location:/Admin/categoriesList');
    }

    public function commentsList(): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAll();
        return $this->twig->render("/Admin/comments_list.html.twig", [
            "comments" => $comments,
        ]);
    }

    public function commentsDelete(int $id)
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $commentsManager = new CommentsManager();
        $commentsManager->deleteComments($id);
        header("Location:/Admin/commentsList");
    }

    public function countriesList(): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectAll();
        return $this->twig->render("/Admin/countries_list.html.twig", [
            "countries" => $countries,
        ]);
    }


    public function countriesAdd()
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["country_name"]) || !isset($_POST["country_name"])) {
                $send = false;
            }
            if (empty($_POST["country_image"]) || !isset($_POST["country_image"])) {
                $send = false;
            }
            if ($send) {
                $countriesManager = new CountriesManager();

                if ($countriesManager->insertCountry($_POST)) {
                    header("Location:/Admin/countriesList");
                }
            }
        }
        return $this->twig->render("/Admin/countries_add.html.twig", [
            "continents" => $this->getContinents(),
        ]);
    }

    public function countriesEdit(int $id): string
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $send = true;

            if (empty($_POST["country_name"]) || !isset($_POST["country_name"])) {
                $send = false;
            }

            if ($send) {
                $countries['id'] = $_POST["country_id"];
                $countries['name'] = $_POST["country_name"];
                $countries['continent_id'] = $_POST["country_continent_id"];

                $countriesManager->updateCountry($countries);
                header("Location:/Admin/countriesList");
            }
        }

        return $this->twig->render('/Admin/countries_edit.html.twig', [
            'countries' => $countries,
            "continents" => $this->getContinents(),
        ]);
    }

    public function countriesDelete(int $id): void
    {
        session_start();
        if ($_SESSION['user'] == 'duotrotter' && $_SESSION['password'] == 'coucou2019') {
        } else {
            header("Location: ../admin/login");
        }
        $countriesManager = new CountriesManager();
        $countriesManager->deleteCountry($id);
        header('Location:/Admin/countriesList');
    }
}
