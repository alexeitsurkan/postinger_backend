<?php

namespace App\Controller;

use App\Service\PublicPlaceService\PublicPlaceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class PublicPlaceController extends AbstractController
{
    #[Route('/public-places', name: 'public-places', methods: ['POST'])]
    public function get(Request $request, PublicPlaceService $placeService): JsonResponse
    {
        $params = json_decode($request->getContent(),true);
        $params['user_id'] = $this->getUser()->getId();
        $result = $placeService->{$params['method']}($params);

        return new JsonResponse($result);
    }
}
