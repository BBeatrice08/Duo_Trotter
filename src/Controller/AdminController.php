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
        if (!empty($_POST)) {
            if (isset($_POST['user']) || $_POST['password']) {
                if ($_POST['user'] == ADMIN_LOGIN && $_POST['password'] == ADMIN_PASSWORD) {
                    $_SESSION['user'] = $_POST['user'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location: /admin/articlesList');
                } else {
                    header('Location: /admin/login');
                }
            }
        } else {
            return $this->twig->render("/Admin/login.html.twig");
        }
    }

    // Give possibility to add, modify or delete an article for the administrator

    // List all articles in administrator panel
    public function articlesList(): string
    {
        $this->isLog();

        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("/Admin/articles_list.html.twig", [
            "articles" => $articles,
        ]);
    }

    public function articlesAdd(): string
    {
        $this->isLog();

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

            // To upload photo in the new article, depending extension and size

            // Type of file allowed
            $allowedExtensions = ['image/jpg', 'image/png', 'image/gif', 'image/jpeg' ];

            if (!empty($_FILES)) {
                if (in_array($_FILES['article_image']['type'], $allowedExtensions)) {
                    /* Size file allowed */
                    if ($_FILES['article_image']['size'] > 1000000) {
                        $send = false;
                        echo $_FILES['article_image']['name'] . "est trop lourd";
                    } else {
                        $tmpFilePath = $_FILES['article_image']['tmp_name'];
                        if ($tmpFilePath != "") {
                            $pathParts = pathinfo($_FILES['article_image']['name']);
                            $filePath = uniqid("../public/assets/images/uploaded/" . 'image' . true)
                                . '.' . $pathParts['extension'];
                            if (move_uploaded_file($tmpFilePath, $filePath)) {
                                $send = true;
                                echo "L'upload de " . $_FILES['article_image']['name'] . " s'est bien passé !";
                                $articlesManager = new ArticlesManager();
                                $_POST['article_image'] = $filePath;
                                if ($articlesManager->insertArticle($_POST)) {
                                    header("Location:/Admin/articlesList");
                                }
                            }
                        }
                    }
                }
            } elseif (!in_array($_FILES['article_image']['type'], $allowedExtensions)) {
                echo "Mauvaise extension !";
            }
        }


        return $this->twig->render("/Admin/articles_add.html.twig", [
            "categories" => $this->getCategories(),
            "countries" => $this->getCountries(),
        ]);
    }

    // To modify an article
    public function articlesEdit(int $id): string
    {
        $this->isLog();

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

            // To upload a new photo depending of size or extension
            $allowedExtensions = ['image/jpg', 'image/png', 'image/gif', 'image/jpeg'];

            $articles['id'] = $_POST["article_id"];
            if (!empty($_FILES)) {
                if (in_array($_FILES['article_image']['type'], $allowedExtensions)) {
                    if ($_FILES['article_image']['size'] > 1000000) {
                        $send = false;
                        echo $_FILES['article_image']['name'] . "est trop lourd";
                    } else {
                        $tmpFilePath = $_FILES['article_image']['tmp_name'];
                        if ($tmpFilePath != "") {
                            $pathParts = pathinfo($_FILES['article_image']['name']);
                            $filePath = uniqid("../public/assets/images/uploaded/" . 'image' . true) . '.' .
                                $pathParts['extension'];
                            if (move_uploaded_file($tmpFilePath, $filePath)) {
                                $send = true;
                                echo "L'upload de " . $_FILES['article_image']['name'] . " s'est bien passé !";

                                    $articlesManager = new ArticlesManager();
                                    $_POST['article_image'] = $filePath;
                                if ($articlesManager->updateArticle($_POST)) {
                                        header("Location:/Admin/articlesList");
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->twig->render('Admin/articles_edit.html.twig', ['articles' => $articles,
            "countries" => $this->getCountries(),
            "categories" => $this->getCategories(),
        ]);
    }


    public function articlesDelete(int $id): void
    {
        $this->isLog();

        $articlesManager = new ArticlesManager();
        $articlesManager->deleteArticle($id);
        header('Location:/Admin/articlesList');
    }

    // Give the possibility to see, add, edit or delete a category for the administrator

    public function categoriesList():string
    {
        $this->isLog();

        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();
        return $this->twig->render("/Admin/categories_list.html.twig", [
            "categories" => $categories,
        ]);
    }

    public function categoriesAdd(): string
    {
        $this->isLog();

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
        $this->isLog();

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
        $this->isLog();

        $categoriesManager = new CategoriesManager();
        $categoriesManager->delete($id);
        header('Location:/Admin/categoriesList');
    }

    /* Give the possibility to see all the comments for each article and
    delete them if necessary for the administrator */

    public function commentsList(): string
    {
        $this->isLog();

        $commentsManager = new CommentsManager();
        $comments = $commentsManager->listComment();
        return $this->twig->render("/Admin/comments_list.html.twig", [
            "comments" => $comments,
        ]);
    }

    public function commentsDelete(int $id): void
    {
        $this->isLog();

        $commentsManager = new CommentsManager();
        $commentsManager->deleteComments($id);
        header("Location:/Admin/commentsList");
    }

    /* Give the possibility to see, add, modify or delete a country for the administrator */

    public function countriesList(): string
    {
        $this->isLog();

        $countriesManager = new CountriesManager();
        $countries = $countriesManager->selectAll();
        return $this->twig->render("/Admin/countries_list.html.twig", [
            "countries" => $countries,
        ]);
    }

    public function countriesAdd()
    {
        $this->isLog();

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
        $this->isLog();

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
        $this->isLog();
        
        $countriesManager = new CountriesManager();
        $countriesManager->deleteCountry($id);
        header('Location:/Admin/countriesList');
    }
}
