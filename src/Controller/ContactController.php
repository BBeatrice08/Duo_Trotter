<?php

namespace App\Controller;

use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    public function index(): string
    {

        $nameError = "";
        $emailError = "";
        $messageError = "";
        $isValid = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $isValid = true;

            if ((!isset($_POST['name'])) || (empty($_POST["name"]))) {
                $nameError = "Votre nom est vide ou invalide";
                $isValid = false;
            }

            if ((!isset($_POST['email'])) || (empty($_POST["email"]))) {
                $emailError = "Votre email est vide ou invalide";
                $isValid = false;
            }

            if ((!isset($_POST['message'])) || (empty($_POST["message"]))) {
                $messageError = "Votre message est vide ou invalide";
                $isValid = false;
            }
        }

        if ($isValid) {
            $email = (new Email())
                ->from($_POST['email'])
                ->to(MAIL_RECEIVER)
                ->subject('Message from : ' . $_POST['email'])
                ->text($_POST['message'])
                ->html($_POST['message']);
            $transport = new GmailTransport(MAIL_RECEIVER_LOGIN, MAIL_RECEIVER_PASSWORD);
            $mailer = new Mailer($transport);
            $mailer->send($email);
            header('Location: /contact/success');
        }



        return $this->twig->render('Home/contact.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
            "nameError" => $nameError,
            "emailError" => $emailError,
            "messageError" => $messageError,


    /** Get "destinations" and "thèmes" in menu when form is submitted */
    public function success(): string
    {
        return $this->twig->render('Home/success.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
