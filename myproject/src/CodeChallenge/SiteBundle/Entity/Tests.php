<?php

namespace CodeChallenge\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tests
 *
 * @ORM\Table("Tests")
 * @ORM\Entity(repositoryClass="CodeChallenge\SiteBundle\Repository\TestsRepository")
 */
class Tests
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="input", type="text")
     */
    private $input;

    /**
     * @var string
     *
     * @ORM\Column(name="output", type="text")
     */
    private $output;


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
     * Set nom
     *
     * @param string $nom
     * @return Tests
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set input
     *
     * @param string $input
     * @return Tests
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get input
     *
     * @return string 
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set output
     *
     * @param string $output
     * @return Tests
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get output
     *
     * @return string 
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set problem
     *
     * @param \CodeChallenge\SiteBundle\Entity\Problems $problem
     * @return Tests
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
}
