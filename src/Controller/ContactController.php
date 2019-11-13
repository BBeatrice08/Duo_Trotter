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
             ->to('duotrotter@gmail.com')
            ->subject('Message from : ' . $_POST['email'])
             ->text($_POST['message'])
             ->html($_POST['message']);
         $transport = new GmailTransport('duotrotter', 'coucou2019');
         $mailer = new Mailer($transport);
         $mailer->send($email);
         header('Location: ../contact/success');
    }

    public function success(): string
    {
        return $this->twig->render('Home/success.html.twig', [
            "categories" => $this->getCategories(),
            "continents" => $this->getContinents(),
        ]);
    }
}
