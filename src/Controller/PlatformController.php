<?php

namespace App\Controller;

use App\Service\PlatformService\Enum\Platform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlatformController extends AbstractController
{
    #[Route('/platforms/get', name: 'platforms', methods: ['POST'])]
    public function get(
    ): JsonResponse {
       return new JsonResponse(Platform::getDescription());
    }
}
