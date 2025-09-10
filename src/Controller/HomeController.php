<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    


    #[Route('/', name: 'app_home')]
    public function index(ListingRepository $listingRepository): Response
    {
         
        
        $properties = $listingRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties,
            
        ]);
    }
}
