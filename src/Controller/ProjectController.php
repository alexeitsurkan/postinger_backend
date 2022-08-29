<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class ProjectController extends AbstractController
{
    #[Route('/project/add', name: 'project_add', methods: ['POST'])]
    public function add(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/project/delete', name: 'project_delete', methods: ['POST'])]
    public function delete(): JsonResponse
    {
        //todo a.curkan сделать
    }
}
