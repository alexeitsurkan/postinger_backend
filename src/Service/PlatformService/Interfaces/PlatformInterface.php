<?php

namespace App\Service\PlatformService\Interfaces;


interface PlatformInterface
{
    public function publicPlace(): PublicPlaceInterface;

    public function post(): PostInterface;
}