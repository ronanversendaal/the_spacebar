<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @param ArticleRepository $repository
     * @return Response
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @param $slug
     * @param MarkdownHelper $markdownHelper
     * @param $isDebug
     * @param SlackClient $client
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function show(Article $article, MarkdownHelper $markdownHelper, $isDebug, SlackClient $client, EntityManagerInterface $em)
    {
        if($article->getSlug() === 'slack') {
            $client->sendMessage('Sloth', 'This article is slack man');
        }

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart")
     * @param Article $article
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function toggleArticleHeart(Article $article, EntityManagerInterface $entityManager)
    {
        $article->incrementHeartCount();

        $entityManager->flush();

        return $this->json(['hearts' => $article->getHeartCount()]);
    }
}