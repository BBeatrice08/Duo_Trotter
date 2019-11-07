<?php


namespace App\Controller;

use App\Model\AdminManager;
use App\Model\ArticlesManager;
use App\Model\CategoriesManager;
use App\Model\CommentsManager;

class AdminController extends AbstractController
{
    public function articlesList()
    {
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("/Admin/articles_list.html.twig", [
            "articles" => $articles,
        ]);
    }

    public function articlesAdd()
    {
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

    public function articlesEdit($id)
    {
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

    public function articlesDelete($id): void
    {
        $articlesManager = new ArticlesManager();
        $articlesManager->deleteArticle($id);
        header('Location:/Admin/articlesList');
        //return $this->twig->render("Admin/articlesList");
    }

    public function categoriesList()
    {
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();
        return $this->twig->render("/Admin/categories_list.html.twig", [
            "categories" => $categories,
        ]);
    }

    public function categoriesAdd()
    {
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

    public function categoriesEdit($id)
    {
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

    public function categoriesDelete($id)
    {
        $categoriesManager = new CategoriesManager();
        $categoriesManager->delete($id);
        header('Location:/Admin/categoriesList');
    }

    public function commentsList()
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAll();
        return $this->twig->render("/Admin/comments_list.html.twig", [
            "comments" => $comments,
        ]);
    }

    public function commentsAdd()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["comment_user_name"]) || !isset($_POST["comment_user_name"])) {
                $send = false;
            }

            if (empty($_POST["comment_date"]) || !isset($_POST["comment_date"])) {
                $send = false;
            }

            if (empty($_POST["comment_content"]) || !isset($_POST["comment_content"])) {
                $send = false;
            }
            if ($send) {
                $commentsManager = new CommentsManager();

                if ($commentsManager->insertComment($_POST)) {
                    header("Location:/Admin/commentsList");
                }
            }
        }

        return $this->twig->render("/Admin/comments_add.html.twig", [
            "articles" => $this->getComments(),

        ]);
    }
}
