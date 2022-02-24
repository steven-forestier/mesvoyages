<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author Eydrin
 */
class ContactController extends AbstractController{
    
    /**
     * 
     * @param \SwiftMailer $mailer
     * @param Contact $contact
     */
    public function envoiMail(\SwiftMailer $mailer, Contact $contact){
        $message = (new \Swift_Message('message du site de voyages'))
            ->setFrom($contact->getEmail())
            ->setTo('contact@mesvoyages.fr')
            ->setBody(
                    $this->renderView(
                        'pages/_email.html.twig',[
                            'contact'=>$contact
                        ]
                    ),
                'text/html'
            )
        ;
        $mailer->send($message);
    }
    
    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function index(Request $request, \Siwft_Mailer $mailer): Response{
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class,$contact);
        $formContact->handleRequest($request);
        
        if($formContact->isSubmitted() && $formContact->isValid()){
            //envoi du mail
            $this->envoiMail($mailer, $contact);
            $this->addFlash('succes', 'message envoyé');
            return $this->redirectToRoute('contact');
        }
        
        return $this->render("pages/contact.html.twig", [
            'contact' => $contact,
            'formcontact' => $formContact->createview()
        ]);
    }
    
}