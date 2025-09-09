<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Repository\ListingRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HouseController extends AbstractController
{
    #[Route('/house', name: 'app_house')]
    public function index(ListingRepository $listingRepository): Response
    {
        $properties = $listingRepository->findAll();
        return $this->render('house/index.html.twig', [
            'controller_name' => 'HouseController',
            'properties' => $properties,
        ]);
    }
    
    #[Route('/house/{id}', name: 'app_house_show')]
    public function show(
        #[MapEntity] 
        Listing $properties
    ): Response
    {
        return $this->render('house/showHouse.html.twig', [
            'property' => $properties,
        ]);
    }
}