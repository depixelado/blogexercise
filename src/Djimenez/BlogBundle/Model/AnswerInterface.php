<?php
namespace Djimenez\BlogBundle\Model;

interface AnswerInterface
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