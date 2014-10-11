<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeChallenge\SiteBundle\Form\ChallengeAjoutType;
use CodeChallenge\SiteBundle\Form\ProblemeAjoutType;
use CodeChallenge\SiteBundle\Form\TestAjoutType;
use CodeChallenge\SiteBundle\Entity\Challenges;
use CodeChallenge\SiteBundle\Entity\Tests;
use CodeChallenge\SiteBundle\Entity\Problems;


class AdminController extends Controller {

    public function adminAction() {
        
        $form1 = $this->createForm(new ChallengeAjoutType());
        if ($this->get('request')->getMethod() == "POST") {
            $form1->bind($this->get('request'));
            $challenge = new Challenges();
            $nom = $form1['nom']->getData();
            $challenge->setnom($nom);
            $duree = $form1['duree']->getData();
            $challenge->setduree($duree);
            $nbrproblems = $form1['nombreProblemes']->getData();
            $challenge->setnbrProblems($nbrproblems);
            $language = $form1['languages']->getData();
            $challenge->setlanguage($language);
            $dateDebut = $form1['dateDebut']->getData();
            $challenge->setdateDebut($dateDebut);
            $this->get('session')->getFlashBag()->add('challenge', $challenge);
            
            
            
            
            
            
            $nbr_problem = $form1['nombreProblemes']->getData();
      
            //store nbr_problem to pass it to another action
            $this->get('session')->getFlashBag()->add('nbr_problem', $nbr_problem);
            
            $form2 = $this->createForm(new ProblemeAjoutType());
            $prob = 1;
            return $this->render('CodeChallengeSiteBundle:administration:prob_ajout.html.twig', array('form' => $form2->createView(), 'prob' => $prob));
        }

        return $this->render('CodeChallengeSiteBundle:administration:admin.html.twig', array('form' => $form1->createView()));
    }

    public function probAction($prob) {
        $form2 = $this->createForm(new ProblemeAjoutType());
        if ($this->get('request')->getMethod() == "POST") {
            $form2->bind($this->get('request'));
            $problem = new Problems();
            $nom = $form2['nom']->getData();
            $problem->setnom($nom);
            $level = $form2['level']->getData();
            $problem->setlevel($level);
            $nbrtest = $form2['nombreTestes']->getData();
            $problem->setnbrtest($nbrtest);
            $content = $form2['content']->getData();
            $problem->setcontent($content);
            $score = $form2['score']->getData();
            $problem->setscore($score);
            $this->get('session')->getFlashBag()->add('problem', $problem);
            
            $nbr_test = $form2['nombreTestes']->getData();
           
            //store nbr_test to pass it to another action
            $this->get('session')->getFlashBag()->add('nbr_test', $nbr_test);
           
             
            $form3 = $this->createForm(new TestAjouttype());
            $test = 1;
            return $this->render('CodeChallengeSiteBundle:administration:test_ajout.html.twig', array('form' => $form3->createView(), 'prob' => $prob, 'test' => $test));
        }
    }

    public function testAction($prob, $test) {
        $form3 = $this->createForm(new TestAjoutType());
        if ($this->get('request')->getMethod() == "POST") {
            $form3->bind($this->get('request'));
            $test1 = new Tests();
            $nom = $form3['nom']->getData();
            $test1->setnom($nom);
            $input = $form3['input']->getData();
            $test1->setinput($input);
            $output = $form3['output']->getData();
            $test1->setoutput($output);
            $this->get('session')->getFlashBag()->add('test1', $test1);
             //get nbr_test
            $imp1 = $this->get('session')->getFlashBag()->get('nbr_test');
            $nbr_test= $imp1[0];
            
            
            
            if ($test == $nbr_test) {
                $form2 = $this->createForm(new ProblemeAjoutType());
                     //get nbr_problem
                     $imp = $this->get('session')->getFlashBag()->get('nbr_problem');
                     $nbr_problem= $imp[0];
                     
                 if ($prob == $nbr_problem) {
                      $imp5 = $this->get('session')->getFlashBag()->get('test1');
                      $this->get('session')->getFlashBag()->add('imp5', $imp5);
                      $em = $this->getDoctrine()->getManager();
                      $imp2 = $this->get('session')->getFlashBag()->get('challenge');
                      $challenge= $imp2[0];
                      $em->persist($challenge);
                      $imp3 = $this->get('session')->getFlashBag()->get('problem');
                      $imp6 = $this->get('session')->getFlashBag()->get('imp5');
                      for($i=0;$i<$nbr_problem;$i++){
                      $imp3[$i]->setChallenge($challenge);
                      $em->persist($imp3[$i]); 
                      foreach ($imp6[$i] as $j => $value){
                        $value->setProblem($imp3[$i]);
                        $em->persist($value);
                      }
                      
                      }
                      $em->flush();
                return $this->render('CodeChallengeSiteBundle:administration:test.html.twig'); 
                 }
                 //restore nbr de problem
                 $this->get('session')->getFlashBag()->add('nbr_problem', $nbr_problem);
                  $imp5 = $this->get('session')->getFlashBag()->get('test1');
                  $this->get('session')->getFlashBag()->add('imp5', $imp5);
                 return $this->render('CodeChallengeSiteBundle:administration:prob_ajout.html.twig', array('form' => $form2->createView(), 'prob' => $prob + 1));
               
            } else {
                 //restore nbr de test
                 $this->get('session')->getFlashBag()->add('nbr_test', $nbr_test);
                 return $this->render('CodeChallengeSiteBundle:administration:test_ajout.html.twig', array('form' => $form3->createView(), 'prob' => $prob, 'test' => $test+1));
            }
        }
    }

}
