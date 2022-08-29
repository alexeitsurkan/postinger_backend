<?php

namespace App\Service\PlatformService;

use App\Service\PlatformService\Enum\Platform;
use App\Service\PlatformService\platforms\telegram\Telegram;
use App\Service\PlatformService\platforms\vkontakte\Vkontakte;

class PlatformManager
{
    public function get(int $id)
    {
        $class = match (Platform::from($id)) {
            Platform::Vkontakte => Vkontakte::class,
            Platform::Telegram => Telegram::class
        };

        return new $class();
    }
}