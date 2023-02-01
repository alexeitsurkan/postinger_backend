<?php

namespace App\Service\PlatformService\platforms\vkontakte;

use App\Service\AccountService\AccountService;
use App\Service\PlatformService\Interfaces\AccountInterface;
use App\Service\PlatformService\Interfaces\PlatformInterface;
use App\Service\PlatformService\platforms\vkontakte\Actions\Account;
use App\Service\PlatformService\platforms\vkontakte\Actions\Post;
use App\Service\PlatformService\platforms\vkontakte\Actions\PublicPlace;
use VK\Client\VKApiClient;

class Vkontakte implements PlatformInterface
{
    private VKApiClient $client;

    /**
     * @var Post
     */
    private $post;

    /**
     * @var PublicPlace
     */
    private $publicPlace;


    /**
     * @var Account
     */
    private $account;

    public function __construct()
    {
        $this->client = new VKApiClient();
    }

    public function post(): Post
    {
        if (!$this->post) {
            $this->post = new Post($this->client);
        }

        return $this->post;
    }

    public function publicPlace(): PublicPlace
    {
        if (!$this->publicPlace) {
            $this->publicPlace = new PublicPlace($this->client);
        }

        return $this->publicPlace;
    }


    public function account(AccountService $accountService): AccountInterface
    {
        if (!$this->account) {
            $this->account = new Account($this->client,$accountService);
        }

        return $this->account;
    }
}