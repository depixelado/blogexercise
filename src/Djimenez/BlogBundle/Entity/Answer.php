<?php

namespace Djimenez\BlogBundle\Entity;

use Djimenez\BlogBundle\Model\ArticleInterface;
use Doctrine\ORM\Mapping as ORM;
use Djimenez\BlogBundle\Model\AnswerInterface;
use Djimenez\BlogBundle\Entity\Article;

/**
 * Answer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Answer implements AnswerInterface
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
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Djimenez\BlogBundle\Entity\Article", inversedBy="answers")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @return ArticleInterface
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param ArticleInterface $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
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
     * @return Answer
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
     * Set body
     *
     * @param string $body
     * @return Answer
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
}
