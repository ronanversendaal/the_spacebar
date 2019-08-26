<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage()
    {
        return $this->render('article/index.html.twig');
    }

    /**
     * @Route("/news/{slug}")
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        $comments = [
            'Comment 1',
            'Comment 2',
            'Comment 3',
        ];

        dump($comments, $this);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments
        ]);
    }
}