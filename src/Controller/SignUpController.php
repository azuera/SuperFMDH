<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SignUpController extends AbstractController
{
    #[Route('/sign/up', name: 'app_sign_up')]
    public function new(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = new User();   
         
        $form = $this->createForm(UserType::class, $user, [ 
            'method' => 'POST',        
            'action' => $this->generateUrl('app_sign_up'),    
        ]);       
        
        $form->handleRequest($request);   
            
        if ($form->isSubmitted() && $form->isValid()) {        
            // Encodez le mot de passe si nécessaire (dépend de votre configuration)
            // $encodedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            // $user->setPassword($encodedPassword);
            
            $entityManager->persist($user);
            $entityManager->flush();
                        
            $this->addFlash('success', 'Inscription réussie !');       
                    
            return $this->redirectToRoute('app_home');   
        }    
        
        return $this->render('sign_up/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}