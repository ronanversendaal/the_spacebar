<?php


namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;   
    }
    
    public function sendMessage(string $from, string $text)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $text
        ]);

        $message = $this->client->createMessage()
            ->to('#testing')
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($text)
        ;

        $this->client->sendMessage($message);
    }

}