<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class PublicPlaceController extends AbstractController
{
    #[Route('/public_places/add', name: 'public_places_add', methods: ['POST'])]
    public function add(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/public_places/delete', name: 'public_places_delete', methods: ['POST'])]
    public function delete(): JsonResponse
    {
        //todo a.curkan сделать
    }
}
