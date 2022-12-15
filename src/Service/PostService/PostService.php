<?php

namespace App\Service\PostService;

use App\Entity\Post;
use App\Entity\PublicPlace;
use App\Entity\User;
use App\Service\PlatformService\PlatformManager;
use Doctrine\Persistence\ManagerRegistry;

class PostService
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private PlatformManager $platformManager
    ) {
    }

    /**
     * возвращает список постов пользователя
     * @param array $params
     * @return float|int|mixed[]|string
     */
    public function get(array $params): array|float|int|string
    {
        $builder = $this->doctrine->getRepository(Post::class)->createQueryBuilder('p');
        $builder->andWhere('p.user = :user')->setParameter('user', $params['user_id']);
        if (!empty($params['ids'])) {
            $builder->andWhere('p.id = :ids')->setParameter('ids', $params['ids']);
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
        $place    = $this->doctrine->getRepository(PublicPlace::class)->find($params['public_place_id']);
        $dateTime = new \DateTime();

        $post = new Post();
        $post->setUser($user);
        $post->setText($params['text']);
        $post->setStatus(0);
        $post->setDatetime($dateTime);

        $post->addPublicPlace($place);

        $this->doctrine->getRepository(Post::class)->add($post, true);

        return true;
    }

    public function update(array $params): void
    {
        $postRepository = $this->doctrine->getRepository(Post::class);
        if ($entity = $postRepository->find($params['id'])) {
            $entity->setText($params['text']);
            $entity->setStatus($params['status']);
            $entity->setDatetime(new \DateTime());
            $postRepository->add($entity, true);
        }
    }

    public function delete(array $params): void
    {
        $postRepository = $this->doctrine->getRepository(Post::class);
        if ($entity = $postRepository->find($params['id'])) {
            $postRepository->remove($entity, true);
        }
    }

    public function send(Post $post): bool
    {
        foreach ($post->getPublicPlaces() as $place) {
            if ($platformId = $place->getAccount()?->getPlatform()) {
                $platform = $this->platformManager->get($platformId);
                $platform->post()->send($post,$place);
            }
        }

        return true;
    }
}