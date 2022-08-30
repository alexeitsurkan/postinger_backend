<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\PlatformService\Enum\Platform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PlatformController extends AbstractController
{
    #[Route('/platforms', name: 'platforms', methods: ['POST'])]
    public function list(
    ): JsonResponse {
       return new JsonResponse(Platform::getDescription());
    }
}
