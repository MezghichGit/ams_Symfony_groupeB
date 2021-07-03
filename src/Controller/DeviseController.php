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
     * @Route("/cours", name="cours",methods={"GET","POST"})
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
            $devisecible = $request->get('devise');
            $montant = $request->get('montant');
            $resultat = $my_service->conversion($from,$devisecible,$montant); 
            $resultat = number_format($resultat, 2);
            $response = new Response(json_encode(array(
                'resultat' =>  $resultat
                )));
            
                $response->headers->set('Content-Type', 'application/json');
                return $response;
    }
    return $this->render('devise/index.html.twig');
       
}


/**
* @Route("/ajax", name="ajax")
*/
public function ajax(Request $request)
{
    /* on récupère la valeur envoyée par la vue */
    $personnage = $request->request->get('personnage');
    
    switch ($personnage) {
            case 'Homer':
                $titre = 'Simpsons';
                $producteur = 'Matt Groening';
            break;
            case 'Cartman':
                $titre = 'South Park';
                $producteur = 'Trey Parker and Matt Stone';
            break;
            case 'Elsa':
                $titre = 'Reine des neiges';
                $producteur = 'Walt Disney Animation Studios';
            break;
            case 'Lord Farquaad':
                $titre = 'Shrek';
                $producteur = 'Dreamworks';
    }
    /* la réponse doit être encodée en JSON ou XML, on choisira le JSON
    * la doc de Symfony est bien faite si vous devez renvoyer un objet
    *
    */
    $response = new Response(json_encode(array(
    'titre' => $titre,
    'producteur' => $producteur
    )));

    $response->headers->set('Content-Type', 'application/json');
    return $response;
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
