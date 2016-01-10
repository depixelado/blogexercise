<?php
namespace Djimenez\BlogBundle\Model;

interface ArticleInterface
{
    /**
     * Set author
     *
     * @param string $author
     * @return PageInterface
     */
    public function setAuthor($author);

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor();

    /**
     * Set title
     *
     * @param string $title
     * @return PageInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set body
     *
     * @param string $body
     * @return PageInterface
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Add answers
     *
     * @param \Djimenez\BlogBundle\Entity\Answer $answers
     * @return Article
     */
    public function addAnswer(\Djimenez\BlogBundle\Entity\Answer $answers);

    /**
     * Remove answers
     *
     * @param \Djimenez\BlogBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Djimenez\BlogBundle\Entity\Answer $answers);

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers();

    /**
     * Add rates
     *
     * @param \Djimenez\BlogBundle\Entity\Rate $rates
     * @return Article
     */
    public function addRate(\Djimenez\BlogBundle\Entity\Rate $rates);

    /**
     * Remove rates
     *
     * @param \Djimenez\BlogBundle\Entity\Rate $rates
     */
    public function removeRate(\Djimenez\BlogBundle\Entity\Rate $rates);

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRates();
}