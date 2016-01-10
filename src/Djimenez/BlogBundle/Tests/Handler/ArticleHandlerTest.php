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

        $this->articleHandler = $this->createArticleHandler($this->om, static::ARTICLE_CLASS);

        $this->articleHandler->get($id);
    }

    protected function createArticleHandler($objectManager, $articleClass)
    {
        return new ArticleHandler($objectManager, $articleClass);
    }

    protected function getArticle()
    {
        $articleClass = static::ARTICLE_CLASS;

        return new $articleClass();
    }
}