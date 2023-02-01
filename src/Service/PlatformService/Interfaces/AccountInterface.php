<?php

namespace App\Service\PlatformService\Interfaces;

use App\Entity\Post;
use App\Entity\PublicPlace;

interface AccountInterface
{
    public function add(array $params): int;
}