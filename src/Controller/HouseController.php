<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Form\ListingType;
use App\Repository\ListingRepository;
use App\Repository\ProperTypeRepository;
use App\Repository\TransactionTypeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HouseController extends AbstractController
{
    #[Route('/house', name: 'app_house')]
    public function index(ListingRepository $listingRepository): Response
    {
        $properties = $listingRepository->findAll();
        
        if (empty($properties)) {
            $this->addFlash('warning', 'Aucune maison n\'a été trouvée dans la base de données.');
        }
        
        return $this->render('house/index.html.twig', [
            'controller_name' => 'HouseController',
            'properties' => $properties,
        ]);
    }
    
    // ⚠️ CETTE ROUTE DOIT ÊTRE PLACÉE AVANT LA ROUTE AVEC {id} 
    #[Route('/house/new', name: 'app_house_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, ProperTypeRepository $properTypeRepo, TransactionTypeRepository $transactionTypeRepo, UserRepository $userRepo): Response
    {
        $user = $this->getUser();
        // Vérifiez si des données existent dans les tables liées
        $hasProperTypes = count($properTypeRepo->findAll()) > 0;
        $hasTransactionTypes = count($transactionTypeRepo->findAll()) > 0;
        $hasUsers = count($userRepo->findAll()) > 0;
        
        if (!$hasProperTypes || !$hasTransactionTypes || !$hasUsers) {
            $this->addFlash('warning', 'Veuillez d\'abord créer des types de propriété, types de transaction et utilisateurs dans la base de données.');
            return $this->redirectToRoute('app_house');
        }
        
        $listing = new Listing();
         $listing->setUserId($user);
        $form = $this->createForm(ListingType::class, $listing);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listing);
            $entityManager->flush();
            
            $this->addFlash('success', 'La maison a été créée avec succès !');
            
            return $this->redirectToRoute('app_house_show', ['id' => $listing->getId()]);
        }
        
        return $this->render('house/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    // ⚠️ CETTE ROUTE DOIT ÊTRE PLACÉE APRÈS LA ROUTE /new ⚠️
    #[Route('/house/{id}', name: 'app_house_show')]
    public function show(int $id, ListingRepository $listingRepository): Response
    {
        $property = $listingRepository->find($id);
        
        if (!$property) {
            throw $this->createNotFoundException('La maison avec l\'ID ' . $id . ' n\'existe pas.');
        }
        
        return $this->render('house/showHouse.html.twig', [
            'property' => $property,
        ]);
    }
}