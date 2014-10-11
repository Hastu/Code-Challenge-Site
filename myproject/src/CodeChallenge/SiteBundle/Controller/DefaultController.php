<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeChallenge\SiteBundle\Form\ContactType;

class DefaultController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Challenges');
        $list = $repository->findBy(array(), array('dateDebut' => 'desc'), 2, 0);
        
        return $this->render('CodeChallengeSiteBundle:Default:index.html.twig', array('listchallenges' => $list, 'user' => $user));

        $form = $this->createForm(new ContactType());
        if ($this->get('request')->getMethod() == "POST") {
            $form->bind($this->get('request'));

            $message = \Swift_Message::newInstance()
                    ->setSubject("from  " . $form['nom']->getData())
                    ->setFrom('send@example.com')
                    ->setTo('code.challenge.ossec@gmail.com')
                    ->setBody($form['message']->getData() . "\n\n\n Email: " . $form['email']->getData() . "\n Telephone: " . $form['telephone']->getData())
            ;
            $this->get('mailer')->send($message);
        }


        return $this->render('CodeChallengeSiteBundle:Default:index.html.twig', array('form' => $form->createView(),'listchallenges' => $list));
    }

      public function lessonsAction() {
        return $this->render('CodeChallengeSiteBundle:Default:lessons.html.twig');
    }
    
     public function allchallengesAction() {
        $user = $this->getUser();
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Challenges');
        $list = $repository->findBy(array(), array('dateDebut' => 'desc'), 1000, 0);
        return $this->render('CodeChallengeSiteBundle:Default:allchallenges.html.twig', array('listchallenges' => $list, 'user' => $user));
    }

}
