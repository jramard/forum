<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/posts", name="post_list")
     */
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $posts = $postRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/posts/{category_id}", name="post_category_list")
     */
    public function filter($category_id, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $posts = $postRepository->findBy(array('category' => $category_id));
        $categories = $categoryRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show($id, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $post = $postRepository->findOneBy(array('id' => $id));
        $categories = $categoryRepository->findAll();

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }
}
