<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    /**
     * Give the possibility to the visitor to post a comment on an article
    */
    public function add(int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $send = true;
            if (empty($_POST["comment_user_name"]) || !isset($_POST["comment_user_name"])) {
                $send = false;
            }
            if (empty($_POST["comment_content"]) || !isset($_POST["comment_content"])) {
                $send = false;
            }
            if ($send) {
                $commentsManager = new CommentsManager();

                if ($commentsManager->insertComment($_POST)) {
                    header("Location: /articles/show/" . $id);
                }
            }
        }

        return $this->twig->render("/Comments/add.html.twig", [
            "id" => $id,

        ]);
    }
}
