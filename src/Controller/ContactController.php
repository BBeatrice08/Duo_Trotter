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



        return $this->twig->render('Home/contact.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }

    public function sendmail()
    {
         $email = (new Email())
             ->from($_POST['email'])
             ->to(MAIL_RECEIVER)
            ->subject('Message from : ' . $_POST['email'])
             ->text($_POST['message'])
             ->html($_POST['message']);
         $transport = new GmailTransport(ADMIN_LOGIN, ADMIN_PASSWORD);
         $mailer = new Mailer($transport);
         $mailer->send($email);
         header('Location: /contact/success');
    }

    public function success(): string
    {
        return $this->twig->render('Home/success.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
