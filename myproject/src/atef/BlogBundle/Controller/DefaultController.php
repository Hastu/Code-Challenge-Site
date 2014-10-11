<?php

namespace atef\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('atefBlogBundle:Default:index.html.twig');
    }

    public function FirstPageAction($id)
    {
        return $this->render('atefBlogBundle:Default:first.html.twig',array('id' => $id));
    }

    public function SecondPageAction()
    {
        return $this->render('atefBlogBundle:Default:second.html.twig');
    }
}
