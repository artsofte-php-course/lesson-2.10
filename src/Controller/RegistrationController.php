<?php

namespace App\Controller;

use App\Entity\User;
use App\Type\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController {


    public function registration (Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher) 
    {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $data = $form->getData();
            
            $user = new User();
            $user->setUsername($data['username']);

            $hashedPassword = $hasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            $doctrine->getManager()->persist($user);
            $doctrine->getManager()->flush();

            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
