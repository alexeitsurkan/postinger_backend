<?php

namespace App\Service\PlatformService\platforms\telegram;

use App\Service\PlatformService\Interfaces\PlatformInterface;
use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
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
}