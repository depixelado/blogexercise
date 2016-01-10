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
}