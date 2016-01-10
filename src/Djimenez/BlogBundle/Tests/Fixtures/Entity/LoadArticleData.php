<?php

namespace Djimenez\BlogBundle\Tests\Fixtures\Entity;

use Djimenez\BlogBundle\Entity\Article;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadArticleData implements FixtureInterface
{
    static public $articles = array();

    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setAuthor('author@blogexercise.com');
        $article->setTitle('title');
        $article->setBody('body');

        $manager->persist($article);
        $manager->flush();

        self::$articles[] = $article;
    }
}