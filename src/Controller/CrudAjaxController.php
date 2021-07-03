<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudAjaxController extends AbstractController
{
    /**
     * @Route("/crud/ajax", name="crud_ajax")
     */
    public function index(): Response
    {
        return $this->render('crud_ajax/index.html.twig', [
            'controller_name' => 'CrudAjaxController',
        ]);
    }
}
