<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PublicPlace;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    #[Route('/users/get', name: 'users_get', methods: ['POST'])]
    public function get(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/users/add', name: 'users_add', methods: ['POST'])]
    public function add(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/users/delete', name: 'users_update', methods: ['POST'])]
    public function update(): JsonResponse
    {
        //todo a.curkan сделать
    }

    #[Route('/users/delete', name: 'users_delete', methods: ['POST'])]
    public function delete(): JsonResponse
    {
        //todo a.curkan сделать
    }
}
