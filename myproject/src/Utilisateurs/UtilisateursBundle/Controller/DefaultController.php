<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function utilisateursAction()
    {
        return $this->render('UtilisateursUtilisateursBundle:Default:utilisateurs.html.twig');
    }
}
