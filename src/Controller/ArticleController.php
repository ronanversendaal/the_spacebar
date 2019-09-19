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
    public function show($slug, MarkdownHelper $markdownHelper, $isDebug, SlackClient $client, EntityManagerInterface $em)
    {
        if($slug === 'slack') {
            $client->sendMessage('Sloth', 'This article is slack man');
        }

        $comments = [
            'Comment 1',
            'Comment 2',
            'Comment 3',
        ];

        $repository = $em->getRepository(Article::class);

        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }

        return $this->render('article/show.html.twig', [
            'slug' => $slug,
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'article' => $article
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart")
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!

        $logger->info('Run ./bin/console debug:autowiring to see the services you can inject.');

        return $this->json(['hearts' => random_int(5, 100)]);
    }
}