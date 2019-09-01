<?php


namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    /** @var AdapterInterface */
    private $cache;

    /** @var MarkdownInterface */
    private $markdown;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $markdownLogger)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
    }

    public function parse(string $source): string
    {
        dd($this->cache);
        if(strpos($source, 'bacon') !== false){
            $this->logger->info('Talking bout bacon!');
        }
        try {
            $item = $this->cache->getItem('markdown_' . md5($source));

            if(!$item->isHit()) {
                $item->set($this->markdown->transform($source));
                $this->cache->save($item);
            }
            return $item->get();
        } catch (InvalidArgumentException $e) {
            return '';
        }

    }
}