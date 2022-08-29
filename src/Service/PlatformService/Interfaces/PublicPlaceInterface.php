<?php

namespace App\Service\PlatformService\Interfaces;

interface PublicPlaceInterface
{
    /**
     * @param $account_id
     * @return array
     */
    public function get($account_id): array;
}