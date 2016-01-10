<?php

namespace Djimenez\BlogBundle\Tests\Handler;

use Djimenez\BlogBundle\Handler\ArticleHandler;
use Djimenez\BlogBundle\Model\ArticleInterface;
use Djimenez\BlogBundle\Entity\Article;

class ArticleHandlerTest extends \PHPUnit_Framework_TestCase
{
    const ARTICLE_CLASS = 'Djimenez\BlogBundle\Entity\Article';

    /** @var ArticleHandler */
    protected $articleHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::ARTICLE_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::ARTICLE_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::ARTICLE_CLASS));

    }

    public function testGet()
    {
        $id = 1;
        $article = $this->getArticle();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($article));

        $this->articleHandler = $this->createArticleHandler($this->om, static::ARTICLE_CLASS,  $this->formFactory);

        $this->articleHandler->get($id);
    }

    public function testPost()
    {
        $author = 'author2@blogexercise.com';
        $title = 'title2';
        $body = 'body2';

        $parameters = array('author'=> $author, 'title' => $title, 'body' => $body);

        $article = $this->getArticle();
        $article->setAuthor($author);
        $article->setTitle($title);
        $article->setBody($body);

        $form = $this->getMock('Djimenez\BlogBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($article));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->articleHandler = $this->createArticleHandler($this->om, static::ARTICLE_CLASS,  $this->formFactory);
        $articleObject = $this->articleHandler->post($parameters);

        $this->assertEquals($articleObject, $article);
    }

    protected function createArticleHandler($objectManager, $articleClass, $formFactory)
    {
        return new ArticleHandler($objectManager, $articleClass, $formFactory);
    }

    protected function getArticle()
    {
        $articleClass = static::ARTICLE_CLASS;

        return new $articleClass();
    }
}