<?php
namespace Djimenez\BlogBundle\Tests\Controller;

use Djimenez\BlogBundle\Tests\Fixtures\Entity\LoadArticleData;
use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function customSetUp($fixtures)
    {
        $this->client = static::createClient();
        $this->loadFixtures($fixtures);
    }

    public function testJsonGetArticleAction()
    {
        $fixtures = array('Djimenez\BlogBundle\Tests\Fixtures\Entity\LoadArticleData');
        $this->customSetUp($fixtures);
        $articles = LoadArticleData::$articles;
        $article = array_pop($articles);

        $route =  $this->getUrl('api_v1_get_article', array('id' => $article->getId(), '_format' => 'json'));

        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);
        $content = $response->getContent();

        $decoded = json_decode($content, true);
        $this->assertTrue(isset($decoded['id']));
    }

    public function testJsonPostArticleAction()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/v1/articles.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"author":"author1@blogexercise.com","title":"title1","body":"body1"}'
        );
        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }

    /*public function testJsonPostArticleActionShouldReturn400WithBadParameters()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/v1/articles.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"foo":"bar"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 400, false);
    }*/

    protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson =  true, $contentType = 'application/json')
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', $contentType),
            $response->headers
        );

        if ($checkValidJson) {
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false),
                'is response valid json: [' . $response->getContent() . ']'
            );
        }
    }
}