<?php
namespace Djimenez\BlogBundle\Model;

interface RateInterface
{
    /**
     * Set value
     *
     * @param string $value
     * @return RateInterface
     */
    public function setValue($value);

    /**
     * Get value
     *
     * @return string
     */
    public function getValue();
    /**
     * Set article
     *
     * @param \Djimenez\BlogBundle\Entity\Article $article
     * @return Rate
     */
    public function setArticle(\Djimenez\BlogBundle\Entity\Article $article = null);

    /**
     * Get article
     *
     * @return \Djimenez\BlogBundle\Entity\Article
     */
    public function getArticle();
}