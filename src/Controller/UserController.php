<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users/add', name: 'users_add', methods: ['POST'])]
    public function add(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserRepository $repository
    ): JsonResponse {
        $params = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($params['email']);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $params['password']
            )
        );
        $repository->add($user, true);

        return $this->json(true);
    }

    #[Route('/users/delete', name: 'users_delete', methods: ['POST'])]
    public function delete(Request $request,UserRepository $repository): JsonResponse
    {
        $params = json_decode($request->getContent(), true);
        $entity = $repository->findBy(['id' => $params['id']]);
        $repository->remove($entity,true);
        return $this->json(true);
    }
}
