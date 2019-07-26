<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;


class CategoryController extends AbstractController
{
    /**
     * Lists all Articles.
     * @FOSRest\Get("/category/{id}/article")
     *
     * @return array
     */
    public function getCategoryId(int $id)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        // query for a single Product by its primary key (usually "id")
        $category = $repository->findBy(
            ['category' => $id]
        );
        //dd($category);
        
        return View::create($category, Response::HTTP_OK , []);
    }

     /**
     * Lists all Category.
     * @FOSRest\Get("/category")
     *
     * @return array
     */
    public function getCategorys()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        
        // query for a single Product by its primary key (usually "id")
        $category = $repository->findall();
        // dd($category);
        return View::create($category, Response::HTTP_OK , []);
    }

    /**
     * Lists all Articles.
     * @FOSRest\Get("/category/{categoryId}")
     *
     * @return array
     */
    public function getCategoryAction(int $categoryId)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        
        // query for a single Product by its primary key (usually "id")
        $category = $repository->findById($categoryId);
        
        return View::create($category, Response::HTTP_OK , []);
    }

    /**
     * Create Category.
     * @FOSRest\Post("/category")
     *
     * @return array
     */
    public function postCategoryAction(Request $request)
    {
        $category = new Category();
        $category->setName($request->get('name'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
        return View::create($category, Response::HTTP_CREATED , []);
        
    }
}
