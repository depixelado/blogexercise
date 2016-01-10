<?php
namespace Djimenez\BlogBundle\Handler;


interface ArticleHandlerInterface
{
    /**
     * Get an Article.
     *
     * @param mixed $id
     *
     * @return ArticleInterface
     */
    public function get($id);

    /**
     * Create a new Article.
     *
     * @param array $parameters
     *
     * @return ArticleInterface
     */
    public function post(array $parameters);
}