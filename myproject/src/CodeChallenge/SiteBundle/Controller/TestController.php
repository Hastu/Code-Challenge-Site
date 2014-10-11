<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeChallenge\SiteBundle\Form\testType;

class TestController extends Controller
{
public function testFormulaireAction() {
    $form = $this->createForm(new testType(), array('email' =>'atef@mail.com', 'nom' => 'atef' ,'prenom' => 'arfaoui','sexe' =>"2",  'contenu' =>'Salut  je suis atef '));
        if($this->get('request')->getMethod() == "POST")
        {
            $form->bind($this->get('request'));
            echo $form['email']->getData();    
            die('');
        }
    
    return $this->render('CodeChallengeSiteBundle:Default:test.html.twig', array('form' => $form->createView()));
    } 
}
 