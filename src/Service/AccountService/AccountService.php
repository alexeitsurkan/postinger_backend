<?php

namespace App\Service\AccountService;

use App\Entity\Account;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class AccountService
{
    public function __construct(
        private ManagerRegistry $doctrine,
    ) {
    }

    public function get(array $params): array|float|int|string
    {
        $builder = $this->doctrine->getRepository(Account::class)->createQueryBuilder('acc');
        $builder->andWhere('acc.user = :user')->setParameter('user', $params['user_id']);
        if (!empty($params['ids'])) {
            $builder->andWhere('acc.id = :ids')->setParameter('ids', $params['ids']);
        }
        $query = $builder
            ->setFirstResult($params['Page']['Offset'] ?? 0)
            ->setMaxResults($params['Page']['Limit'] ?? null)
            ->getQuery()
        ;

        return $query->getArrayResult();
    }

    public function add(array $params): bool
    {
        $user     = $this->doctrine->getRepository(User::class)->find($params['user_id']);

        $account = new Account();
        $account->setUser($user);
        $account->setPlatform($params['platform_id']);
        $account->setSid($params['account_id']);
        $account->setAccessToken($params['token']);
        $this->doctrine->getRepository(Account::class)->add($account, true);

        return true;
    }

    public function delete(array $params): void
    {
        $postRepository = $this->doctrine->getRepository(Account::class);
        if ($entity = $postRepository->find($params['id'])) {
            $postRepository->remove($entity, true);
        }
    }
}