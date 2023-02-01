<?php

namespace App\Controller;

use App\Service\AccountService\AccountService;
use App\Service\TelegramSdk\TelegramApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TelegramController extends AbstractController
{
    #[Route('/telegram/get-me', name: 'getMe', methods: ['POST'])]
    public function getMe(Request $request, TelegramApiClient $client): JsonResponse
    {
        $params = json_decode($request->getContent(),true);
        $result = $client->getMe($params['token']);

        return new JsonResponse($result);
    }
}
