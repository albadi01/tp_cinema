<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front")
     */
    public function index(): Response
    {
        return $this->render('front/accueil.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * 
     * @Route("/profil", name="app_profil")
     */
    public function profil(){
        
        if( $this->isGranted("ROLE_USER")){

            return $this->render('front/profil.html.twig',[
                'user' => $this->getUser()
        ]);
        }else{
            return $this->redirectToRoute("app_login");
        }

    }
}
