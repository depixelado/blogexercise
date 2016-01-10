<?php
namespace Djimenez\BlogBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;

class ArticleHandler implements ArticleHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    /**
     * Get an Article.
     *
     * @param mixed $id
     *
     * @return ArticleInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }
}