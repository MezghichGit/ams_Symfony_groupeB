<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Currency;
class DeviseController extends AbstractController
{
    
    /**
     * @Route("/cours", name="cours")
     */

     // injection de dépendence
    public function cours(Currency $my_service)
    {
        // On récupère le service et on spécifie les paramètres
        $from = "USD";
        $to = "EUR";
        $amount = 200;
        return new Response("taux = " . $my_service->conversion($from,$to,$amount));
    }


    
    
    
    /**
     * @Route("/devise", name="devise")
     */
    public function index(): Response
    {
        return $this->render('devise/index.html.twig', [
            'controller_name' => 'DeviseController',
        ]);
    }



}
