<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class PostController extends AbstractController
{
    #[Route('/posts/get', name: 'posts_get', format: 'json', methods: ['POST'])]
    public function get(): JsonResponse
    {
        return new JsonResponse('123');
    }

    #[Route('/posts/add', name: 'posts_add', format: 'json', methods: ['POST'])]
    public function add(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/posts/delete', name: 'posts_update', format: 'json', methods: ['POST'])]
    public function update(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/posts/delete', name: 'posts_delete', format: 'json', methods: ['POST'])]
    public function delete(): JsonResponse
    {
        //todo a.curkan сделать
    }
}
