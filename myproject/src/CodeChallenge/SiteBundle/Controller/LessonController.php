<?php

namespace CodeChallenge\SiteBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LessonController extends Controller
{
    public function lessonAction()
    {
        return $this->render('CodeChallengeSiteBundle:Default:lesson.html.twig');
    }
}
