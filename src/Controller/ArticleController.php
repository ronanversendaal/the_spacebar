<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage()
    {
        return Response::create('Woohoo!');
    }

    /**
     * @Route("/news/{slug}")
     * @return Response
     */
    public function show($slug)
    {
        return Response::create(sprintf('News article title: %s', $slug));
    }
}