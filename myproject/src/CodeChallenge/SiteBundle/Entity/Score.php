<?php

namespace CodeChallenge\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table("Score")
 * @ORM\Entity(repositoryClass="CodeChallenge\SiteBundle\Repository\ScoreRepository")
 */
class Score
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
     * @ORM\ManyToOne(targetEntity="CodeChallenge\SiteBundle\Entity\Challenges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $challenge;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;


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
     * Set score
     *
     * @param integer $score
     * @return Score
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
     * Set time
     *
     * @param \DateTime $time
     * @return Score
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set challenge
     *
     * @param \CodeChallenge\SiteBundle\Entity\Challenges $challenge
     * @return Score
     */
    public function setChallenge(\CodeChallenge\SiteBundle\Entity\Challenges $challenge)
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * Get challenge
     *
     * @return \CodeChallenge\SiteBundle\Entity\Challenges 
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     * @return Score
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
