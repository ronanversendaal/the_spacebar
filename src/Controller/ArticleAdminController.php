<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/admin", name="article_admin")
     */
    public function index()
    {
        return $this->render('article_admin/index.html.twig', [
            'controller_name' => 'ArticleAdminController',
        ]);
    }

    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $entityManager)
    {

        die('todo');
        return new Response(sprintf(
            'New Article id: # %s slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}
