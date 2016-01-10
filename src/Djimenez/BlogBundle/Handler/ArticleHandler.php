<?php
namespace Djimenez\BlogBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Djimenez\BlogBundle\Model\ArticleInterface;
use Djimenez\BlogBundle\Form\ArticleType;
use Djimenez\BlogBundle\Exception\InvalidFormException;

class ArticleHandler implements ArticleHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
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

    /**
     * Create a new Article.
     *
     * @param array $parameters
     *
     * @return ArticleInterface
     */
    public function post(array $parameters)
    {
        $article = $this->createArticle();

        return $this->processForm($article, $parameters, 'POST');
    }

    /**
     * Processes the form.
     *
     * @param ArticleInterface $article
     * @param array         $parameters
     * @param String        $method
     *
     * @return ArticleInterface
     *
     * @throws \Djimenez\BlogBundle\Exception\InvalidFormException
     */
    private function processForm(ArticleInterface $article, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new ArticleType(), $article, array('method' => $method));

        $form->submit($parameters, false); //'PATCH' !== $method);

        if ($form->isValid()) {

            $article = $form->getData();
            $this->om->persist($article);
            $this->om->flush($article);

            return $article;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createArticle()
    {
        return new $this->entityClass();
    }
}