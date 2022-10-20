<?php

namespace App\Command;

use App\Repository\PostRepository;
use App\Service\PostService\PostService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:posting')]
class PostingCommand extends Command
{
    public function __construct(private PostRepository $postRepository,private PostService $postService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $posts = $this->postRepository->getAllForCurrentDate(date('Y-m-d H:i:00'));
        foreach ($posts as $item) {
            $this->postService->send($item);
        }

        return Command::SUCCESS;
    }
}