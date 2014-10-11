<?php

namespace CodeChallenge\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codes
 *
 * @ORM\Table("Codes")
 * @ORM\Entity(repositoryClass="CodeChallenge\SiteBundle\Repository\CodesRepository")
 */
class Codes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="CodeChallenge\SiteBundle\Entity\Problems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $problem;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=255)
     */
    private $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Codes
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Codes
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Codes
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Codes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set problem
     *
     * @param \CodeChallenge\SiteBundle\Entity\Problems $problem
     * @return Codes
     */
    public function setProblem(\CodeChallenge\SiteBundle\Entity\Problems $problem)
    {
        $this->problem = $problem;

        return $this;
    }

    /**
     * Get problem
     *
     * @return \CodeChallenge\SiteBundle\Entity\Problems 
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     * @return Codes
     */
    public function setUser(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs
     */
    public function getUser()
    {
        return $this->user;
    }
}
