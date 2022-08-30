<?php

namespace App\Service\PlatformService\Interfaces;

use App\Entity\Account;

interface PublicPlaceInterface
{
    /**
     * @param Account $account
     * @return array
     */
    public function pull(Account $account): array;
}