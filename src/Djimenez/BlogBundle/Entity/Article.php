<?php

namespace Djimenez\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Djimenez\BlogBundle\Model\ArticleInterface;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Djimenez\BlogBundle\Entity\ArticleRepository")
 */
class Article implements ArticleInterface
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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=40)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var Answer
     *
     * @ORM\OneToMany(targetEntity="Djimenez\BlogBundle\Entity\Answer", mappedBy="article")
     */
    private $answers;

    /**
     * @var Rate
     *
     * @ORM\OneToMany(targetEntity="Djimenez\BlogBundle\Entity\Rate", mappedBy="article")
     */
    private $rates;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->rates = new ArrayCollection();
    }

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
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Add answers
     *
     * @param \Djimenez\BlogBundle\Entity\Answer $answers
     * @return Article
     */
    public function addAnswer(\Djimenez\BlogBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Djimenez\BlogBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Djimenez\BlogBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add rates
     *
     * @param \Djimenez\BlogBundle\Entity\Rate $rates
     * @return Article
     */
    public function addRate(\Djimenez\BlogBundle\Entity\Rate $rates)
    {
        $this->rates[] = $rates;

        return $this;
    }

    /**
     * Remove rates
     *
     * @param \Djimenez\BlogBundle\Entity\Rate $rates
     */
    public function removeRate(\Djimenez\BlogBundle\Entity\Rate $rates)
    {
        $this->rates->removeElement($rates);
    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRates()
    {
        return $this->rates;
    }
}
