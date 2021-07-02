<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Currency;
use Symfony\Component\HttpFoundation\Request;
class DeviseController extends AbstractController
{
    
    /**
     * @Route("/cours", name="cours")
     */

     // injection de dépendence
    public function cours(Currency $my_service, Request $request)
    {
        // On récupère le service et on spécifie les paramètres
        $from = "USD";
        //$to = "EUR";
        $amount = 200;

        $resultat = 0;

    if($request->getMethod()=="POST")
    {
            $devisecible = $request->get('devisecible');
            $montant = $request->get('montant');
            $resultat = $my_service->conversion($from,$devisecible,$montant);        
    }
    return $this->render('devise/index.html.twig', ['resultat' =>  $resultat]);
       
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
