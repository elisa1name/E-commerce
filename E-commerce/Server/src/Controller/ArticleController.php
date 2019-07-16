<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;


class ArticleController extends AbstractController
{
     /**
     * Lists all Articles.
     * @FOSRest\Get("/article")
     *
     * @return array
     */
    public function getArticlesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        // query for a single Product by its primary key (usually "id")
        $article = $repository->findall();
        
        return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Lists all Articles.
     * @FOSRest\Get("/article/{articleId}")
     *
     * @return array
     */
    public function getArticleAction(int $articleId)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        // query for a single Product by its primary key (usually "id")
        $article = $repository->findById($articleId);
        
        return View::create($article, Response::HTTP_OK , []);
    }


    /**
     * Create Article.
     * @FOSRest\Post("/article")
     *
     * @return array
     */
    public function postArticleAction(Request $request)
    {
        //idée je instance category select where $id = id category
        $article = new Article();
        $article->setName($request->get('name'));
        $article->setDescription($request->get('description'));
        $article->setCategory($request->get('category'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        return View::create($article, Response::HTTP_CREATED , []);
        
    }
}
