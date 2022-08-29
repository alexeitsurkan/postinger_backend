<?php

namespace App\Service\PlatformService\Interfaces;

use App\Entity\Post;

interface PostInterface
{
    /**
     * @param Post $post
     * @return bool
     */
    public function send(Post $post): bool;
}