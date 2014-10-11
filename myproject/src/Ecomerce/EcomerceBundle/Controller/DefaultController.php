<?php

namespace Ecomerce\EcomerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EcomerceBundle:Default:index.html.twig', array('name' => $name));
    }
}
