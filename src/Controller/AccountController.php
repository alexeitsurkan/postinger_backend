<?php

namespace App\Controller;

use App\Service\AccountService\AccountService;
use App\Service\PlatformService\PlatformManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/accounts', name: 'accounts', methods: ['POST'])]
    public function get(
        Request $request,
        PlatformManager $platformManager,
        AccountService $accountService
    ): JsonResponse
    {
        $params = json_decode($request->getContent(),true);
        $params['user_id'] = $this->getUser()->getId();
        $result = $platformManager->get($params['platform_id'])->account($accountService)->{$params['method']}($params);

        return new JsonResponse($result);
    }
}
