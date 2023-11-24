<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmEmailController extends AbstractController
{
    #[Route('/contact/confirm', name: 'contact.confirm.index')]
    public function index(): Response
    {
        return $this->render('confirm_email/index.html.twig', [
            'controller_name' => 'ConfirmEmailController',
        ]);
    }
}
