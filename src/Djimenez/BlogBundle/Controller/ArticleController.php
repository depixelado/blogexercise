<?php

namespace Djimenez\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleController extends FOSRestController
{
    /**
     * Get single Article,
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Article for a given id",
     *   output = "Djimenez\BlogBundle\Entity\Article",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the article is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="article")
     *
     * @param int     $id      the article id
     *
     * @return array
     *
     * @throws NotFoundHttpException when article not exist
     */
    public function getArticleAction($id)
    {
        $article = $this->getOr404($id);

        return $article;
    }

    /**
     * Fetch an Article or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return ArticleInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($article = $this->container->get('djimenez_blog.article.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $article;
    }

    /**
     * Create an Article from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new article from the submitted data.",
     *   input = "Djimenez\BlogBundle\Form\ArticleType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DjimenezBlogBundle:Article:newArticle.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postArticleAction(Request $request)
    {
        try {
            $newArticle = $this->container->get('djimenez_blog.article.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newArticle->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_v1_get_article', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
