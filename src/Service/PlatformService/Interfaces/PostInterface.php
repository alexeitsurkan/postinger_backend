<?php

namespace App\Service\PlatformService\Interfaces;

use App\Entity\Post;
use App\Entity\PublicPlace;

interface PostInterface
{
    /**
     * @param Post $post
     * @param PublicPlace $place
     * @return bool
     */
    public function send(Post $post, PublicPlace $place): bool;
}