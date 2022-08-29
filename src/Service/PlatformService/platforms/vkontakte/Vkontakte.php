<?php

namespace App\Service\PlatformService\platforms\vkontakte;

use App\Service\PlatformService\Interfaces\PlatformInterface;
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
}