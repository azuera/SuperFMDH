<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SignOutController extends AbstractController
{
    #[Route('/sign/out', name: 'app_sign_out')]
    public function index(): Response
    {
        return $this->render('sign_out/index.html.twig', [
            'controller_name' => 'SignOutController',
        ]);
    }
}
