<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeChallenge\SiteBundle\Form\ContactType;

class ContactController extends Controller
{
public function contactAction() {
    $form = $this->createForm(new ContactType(), array('email' =>'atef@mail.com', 'nom' => 'atef' ,'prenom' => 'arfaoui','sexe' =>"2",  'contenu' =>'Salut  je suis atef '));
    
    return $this->render('CodeChallengeSiteBundle:Default:index.html.twig', array('form' => $form->createView()));
    } 
}
 