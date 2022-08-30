<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account/add', name: 'public_places_add', methods: ['POST'])]
    public function add(Request $request, AccountRepository $accountRepository): JsonResponse
    {
        $params = json_decode($request->getContent(), true);

        $account = new Account();
        $account->setUser($this->getUser());
        $account->setPlatform($params['platform_id']);
        $account->setSid($params['account_id']);
        $account->setAccessToken($params['token']);
        $accountRepository->add($account, true);

        return $this->json(true);
    }
}
