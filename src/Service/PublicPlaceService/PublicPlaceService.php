<?php

namespace App\Service\PublicPlaceService;

use App\Entity\Account;
use App\Entity\PublicPlace;
use App\Service\PlatformService\PlatformManager;
use Doctrine\Persistence\ManagerRegistry;

class PublicPlaceService
{
    public function __construct(private ManagerRegistry $doctrine, private PlatformManager $platformManager)
    {
    }

    public function add(array $params): bool
    {
        foreach ($params['PublicPlaces'] as $item){
            $account = $this->doctrine->getRepository(Account::class)->findOneBy(
                [
                    'id' => $item['account_id'],
                    'user' => $params['user_id'],
                ]
            );

            $publicPlace = new PublicPlace();
            $publicPlace->setAccount($account);
            $publicPlace->setName($item['name']);
            $publicPlace->setSid($item['public_place_id']);
            $this->doctrine->getRepository(PublicPlace::class)->add($publicPlace, true);
        }

        return true;
    }

    public function delete(array $params): void
    {
        $placeRepository = $this->doctrine->getRepository(PublicPlace::class);
        $entity = $placeRepository->findBy(
            [
                'id' => $params['id'],
                'user' => $params['user_id'],
            ]
        );
        $placeRepository->remove($entity,true);
    }

    public function get(array $params): array|float|int|string
    {
        $builder = $this->doctrine->getRepository(PublicPlace::class)->createQueryBuilder('pp');
//        $builder->andWhere('pp.user = :user')->setParameter('user', $params['user_id']);
        if (!empty($params['ids'])) {
            $builder->andWhere('pp.id = :ids')->setParameter('ids', $params['ids']);
        }
        $query = $builder
            ->setFirstResult($params['Page']['Offset'] ?? 0)
            ->setMaxResults($params['Page']['Limit'] ?? null)
            ->getQuery()
        ;

        return $query->getArrayResult();
    }

    public function pull(array $params): array
    {
        $platform = $this->platformManager->get($params['platform_id']);
        $account = $this->doctrine->getRepository(Account::class)->find($params['account_id']);
        return $platform->publicPlace()->pull($account);
    }
}