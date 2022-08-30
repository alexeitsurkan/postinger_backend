<?php

namespace App\Controller;

use App\Service\PostService\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/posts', name: 'posts', methods: ['POST'])]
    public function get(Request $request, PostService $postService): JsonResponse
    {
        $params = json_decode($request->getContent(),true);
        $params['user_id'] = $this->getUser()->getId();
        $result = $postService->{$params['method']}($params);

        return new JsonResponse($result);
    }
}
