<?php

namespace App\Command;

use App\Repository\PostRepository;
use App\Service\PlatformService\PlatformManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:posting')]
class PostingCommand extends Command
{
    public function __construct(private PostRepository $postRepository,private PlatformManager $platformManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $posts = $this->postRepository->getAllForCurrentTime(time());
        foreach ($posts as $item) {
            $post = $this->postRepository->find($item['id']);

            foreach ($post->getAccounts() as $account) {
                $platform = $this->platformManager->get($account->getPlatform());
                $platform->post()->send();
            }
        }

        return Command::SUCCESS;
    }
}