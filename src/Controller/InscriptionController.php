<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder): Response
    {   
        if ($this->getUser()) { //si je suis deja connete tu me redirige a la page de profil
            $this->addFlash("warning","Attention vous avez deja un compte.");
            
            return $this->redirectToRoute('app_profil');
        }
        $user = new User(); //cree nouveau $user 
        /**
         * @param string $type 
         * @param array Options
         * @return formInterface
         */
        $form = $this->createForm(UserType::class, $user ); //on cree le formulaire avec createForm qui a pour parametre le type de la classe et objet de la classe (UserType::class, $user) 



        $form->handleRequest($request); // #stocke les donnees #verifie s ils sont soumis ou pas

        
        if($form->isSubmitted() && $form->isValid()){ //on fait le test

            $password = $encoder->hashPassword($user, $user->getPassword()) ;//  il hache le mot de passe que l'utilisateur nous a donne 
            //deux parametres($user, $user->getPassword())

            $user->setPassword($password);//on injecte le mot de passe recupere dans notre objet $user 

            $manager->persist($user); //preparation des donnees pas connu de la classe pour mieux les gerer

            $manager->flush(); //on pousse les donnnees Cela synchronise efficacement l'état en mémoire des objets gérés avec la base de données.

            $this->addFlash('success', 'bravo vous etes inscrit, maintenant vous pouvez vous conneter'); //stoque des courts messages dans des variables globales

            return $this->redirectToRoute('app_login');

        }


        // dd($request);

        return $this->renderForm('front/inscription.html.twig', [
            'formUser' => $form ,
        ]);
    }
}
