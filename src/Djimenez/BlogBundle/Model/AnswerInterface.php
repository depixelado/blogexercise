<?php
namespace Djimenez\BlogBundle\Model;

interface AnswerInterface
{
    /**
     * Set author
     *
     * @param string $author
     * @return AnswerInterface
     */
    public function setAuthor($author);

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor();

    /**
     * Set body
     *
     * @param string $body
     * @return AnswerInterface
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Set article
     *
     * @param \Djimenez\BlogBundle\Entity\Article $article
     * @return AnswerInterface
     */
    public function setArticle(\Djimenez\BlogBundle\Entity\Article $article = null);

    /**
     * Get article
     *
     * @return ArticleInterface
     */
    public function getArticle();
}