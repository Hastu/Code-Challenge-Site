<?php

namespace CodeChallenge\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeChallenge\SiteBundle\Entity\Codes;
use CodeChallenge\SiteBundle\Entity\Score;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\PropertyAccess\PropertyAccess;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChallengeController extends Controller {

    public function challengeAction($prob, $chall, $lang) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository1 = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Challenges');
        $challenge = $repository1->findOneBy(array('nom' => $chall));
        $accessor = PropertyAccess::createPropertyAccessor();
        //test sur date
        $date_debut = $accessor->getValue($challenge, 'date_debut');
        $duree = $accessor->getValue($challenge, 'duree');

        $time_test = $this->comparedate($date_debut, $duree);
        if ($time_test == 0) {
            $this->get('session')->getFlashBag()->add('$date_debut', $date_debut);
            return $this->redirect($this->generateUrl('attente'));
        }
        if ($time_test == 2) {
            $this->get('session')->getFlashBag()->add('chall', $chall);
            return $this->redirect($this->generateUrl('classement'));
        }


        //nbr problemes
        $nbr_prob = $accessor->getValue($challenge, 'nbr_problems');
        //ennoncé du probleme 

        $repository2 = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Problems');
        $problem = $repository2->findOneBy(array('nom' => $prob, 'challenge' => $challenge));

        $nbr_test = $accessor->getValue($problem, 'nbr_test');
        //code
        $repository3 = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Codes');
        $code = $repository3->findOneBy(array('user' => $this->getUser(), 'problem' => $problem, 'language' => $lang, 'user' => $this->getUser()));
        //score
        $repository4 = $this->getDoctrine()
                ->getManager()
                ->getRepository('CodeChallengeSiteBundle:Score');
        $scor = $repository4->findOneBy(array('user' => $this->getUser(), 'challenge' => $challenge));



        $out = array();
        $score = 0;

        if ($this->get('request')->getMethod() == 'POST') {
            $request = $this->getRequest();
            $postData = $request->request->get('code');
            for ($i = 1; $i < $nbr_test + 1; $i++) {
                $nom = "test" . $i;

                //input et output
                $repository3 = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('CodeChallengeSiteBundle:Tests');
                $test = $repository3->findOneBy(array('problem' => $problem, 'nom' => $nom));
                $input = $accessor->getValue($test, 'input');
                $output = $accessor->getValue($test, 'output');
           
                //compilation
                $builder1 = new ProcessBuilder(array("./kernel.sh", $postData, $input, $output, $lang));
                $process1 = $builder1->getProcess();
                $process1->run();

                //affichage compilation
                $out[$i - 1] = ($process1->getOutput());
                $x = $out[$i - 1];
                if (trim($x) === "Bravo!") {
                    $score = $score + 100 / $nbr_test;
                }
                if (trim($x) ==="erreur de compilation !")
                {
                    $out['0'] = ($process1->getErrorOutput());
                    $out[$i] = "Erreur de compilation !";
                }
            }





            $em = $this->getDoctrine()->getManager();

            if (!$code) {
                $code = new Codes();
                $code->setcontent("$postData");
                $code->setlanguage("$lang");
                $code->setscore($score);
                $code->setdate(new \DateTime("now"));
                $code->setProblem($problem);
                $code->setUser($this->getUser());
                $em->persist($code);
                $em->flush();
                //score du challenge:
                if ($scor) {
                    $score_ancien = $accessor->getValue($scor, 'score');
                } else {
                    $score_ancien = 0;
                }
                $score_nouveau = $score_ancien + $score / $nbr_prob;
            } else {
                $score_an = $accessor->getValue($code, 'score');
                $code->setcontent("$postData");
                $code->setscore($score);
                $code->setdate(new \DateTime("now"));
                $em->flush();
                //score du challenge:
                if ($scor) {
                    $score_ancien = $accessor->getValue($scor, 'score');
                } else {
                    $score_ancien = 0;
                }
                $score_nouveau = $score_ancien - ($score_an / $nbr_prob) + ($score / $nbr_prob);
            }
            if (!$scor) {
                $scor = new Score();
                $scor->setscore("$score_nouveau");
                $scor->settime(new \DateTime("now"));
                $scor->setChallenge($challenge);
                $scor->setUser($this->getUser());
                $em->persist($scor);
                $em->flush();
            } else {
                $scor->setscore("$score_nouveau");
                $scor->settime(new \DateTime("now"));
                $em->flush();
            }
        }


        if ($lang == "c") {
            return $this->render('CodeChallengeSiteBundle:mode:c.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        } else if ($lang == "cpp") {
            return $this->render('CodeChallengeSiteBundle:mode:cpp.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        } else if ($lang == "java") {
            return $this->render('CodeChallengeSiteBundle:mode:java.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        } else if ($lang == "python") {
            return $this->render('CodeChallengeSiteBundle:mode:python.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        } else if ($lang == "shell") {
            return $this->render('CodeChallengeSiteBundle:mode:shell.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        } else {
            return $this->render('CodeChallengeSiteBundle:mode:shell.html.twig', array('prob' => $prob,
                        'lang' => $lang,
                        'chall' => $chall,
                        'problem' => $problem,
                        'code' => $code,
                        'result' => $out,
                        'nbr_prob' => $nbr_prob,
                        'score' => $score,
                        'nbr_test' => $nbr_test,
                        'user' => $user
            ));
        }
    }

    public function comparedate($date_debut, $duree) {
        $date_deb = $date_debut->format('m/d/Y');
        $time_deb = $date_debut->format('H:i:s');
        $date = date('m/d/Y');
        $time = date('H:i:s');
        if ($date < $date_deb) {
            return 0;
        } // pas encore
        else if ($date == $date_deb) {

            if ($time < $time_deb) {
                return 0;
            } // pas encore
            else {
                if ($date_debut->format('H') + $duree < date('H')) {
                    return 2;
                } // classement
                else {
                    return 1;
                }// go
            }
        } else {

            return 2;
        }
    }

}
