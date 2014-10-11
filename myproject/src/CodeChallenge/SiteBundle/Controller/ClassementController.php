<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassementController extends Controller {

    public function classementAction() {
        $user = $this->getUser();
        $chall = $this->get('session')->getFlashBag()->get('chall');
        $challen = $chall[0];
        $repository1 = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Challenges');
        $challenge = $repository1->findOneBy(array('nom' => $challen));

        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Score');
        $list = $repository->findBy(array('challenge' => $challenge), array('score' => 'desc', 'time' => 'desc'), 1000, 0);
        
        return $this->render('CodeChallengeSiteBundle:Default:classement.html.twig', array('list' => $list, 'user' => $user));
    }

}
