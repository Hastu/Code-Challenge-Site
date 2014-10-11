<?php

namespace Ecomerce\EcomerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction() 
    {
        return $this->render('EcomerceBundle:Blog:index.html.twig', array('nom' => 'atef' ));

    }
}
