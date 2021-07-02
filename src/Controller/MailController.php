<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(): Response
    {
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }

/**
* @Route("/sendmail", name="sendmail")
*/
public function testMail(\Swift_Mailer $mailer, Request $request)
{

    if($request->getMethod()=="POST")
    {

            $emailTo = $request->get('emailTo');
            $sujet = $request->get('sujet');
            $message = $request->get('message');

            $messageToSend = (new \Swift_Message($sujet))
            ->setFrom('amsgroupea@gmail.com')
            ->setTo($emailTo)
            ->setBody(
            $this->renderView('mail/message.html.twig',['msg' =>  $message]),'text/html');
            $mailer->send($messageToSend);
            return $this->redirectToRoute('sendmail');
    }
    return $this->render('mail/index.html.twig');
    }
}
