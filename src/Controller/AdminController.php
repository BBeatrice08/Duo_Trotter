<?php


namespace App\Controller;

use App\Model\AdminManager;
use App\Model\ArticlesManager;
use App\Model\CategoriesManager;

class AdminController extends AbstractController
{
    public function articlesList()
    {
        $articlesManager = new AdminManager();
        $articles = $articlesManager->selectAllByDate();
        return $this->twig->render("Admin/articles_list.html.twig", [
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
        return $this->twig->render("Admin/articles_add.html.twig");
    }

    
/**
    public function articlesEdit(): string
    {

    }

**/

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
        return $this->twig->render("Admin/categories_list.html.twig", [
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
        return $this->twig->render("Admin/categories_add.html.twig");
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

        return $this->twig->render('Admin/categories_edit.html.twig', ['categories' => $categories]);
    }

    public function categoriesDelete($id)
    {
        $categoriesManager = new CategoriesManager();
        $categoriesManager->delete($id);
        header('Location:/Admin/categoriesList');
    }
}
