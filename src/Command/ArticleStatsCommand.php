<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Return article stats.')
            ->addArgument('slug', InputArgument::REQUIRED, 'The article slug')
            ->addOption('format', '-f', InputOption::VALUE_REQUIRED, 'The output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
            'slug' => $slug,
            'heats' => rand(10, 100)
        ];

        switch ($input->getOption('format')){
            case 'text':
                $rows = [];
                foreach ($data as $key => $value) {
                    $rows[] = [$key, $value];
                }

                $io->table(['key', 'value'], $rows);
                break;
            case 'json':
                $output->write(json_encode($data));
                break;
            default:
                throw new \Exeption('No such format fool!');
        }
    }
}
