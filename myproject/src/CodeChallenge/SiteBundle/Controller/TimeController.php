<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimeController extends Controller
{
    public function timeAction()
    {
         $user = $this->getUser();
        return $this->render('CodeChallengeSiteBundle:Default:time.html.twig', array('user' => $user));
    }
}