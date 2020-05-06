<?php
namespace App\Repository\User;

use App\Repository\EntityTrait;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    use EntityTrait;

    public function loadUserByUsername($email)
    {
        return $this->createQuery(
            'SELECT u
                FROM App\Entity\User u
                WHERE u.email = :query'
        )
            ->setParameter('query', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}