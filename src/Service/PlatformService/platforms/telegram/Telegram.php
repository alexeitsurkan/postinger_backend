<?php

namespace App\Service\PlatformService\platforms\telegram;

use App\Service\AccountService\AccountService;
use App\Service\PlatformService\Interfaces\AccountInterface;
use App\Service\PlatformService\Interfaces\PlatformInterface;
use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
use App\Service\PlatformService\platforms\telegram\Actions\Account;
use App\Service\PlatformService\platforms\telegram\Actions\Post;
use App\Service\PlatformService\platforms\telegram\Actions\PublicPlace;
use App\Service\TelegramSdk\TelegramApiClient;

class Telegram implements PlatformInterface
{
    private TelegramApiClient $client;

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
        $this->client = new TelegramApiClient();
    }

    public function post(): Post
    {
        if (!$this->post) {
            $this->post = new Post($this->client);
        }

        return $this->post;
    }

    public function publicPlace(): PublicPlaceInterface
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