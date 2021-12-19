<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\User;
use App\Exception\Client\ClientNotFoundException;
use App\Exception\User\UserNotFoundException;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class DoctrineClientRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Client::class;
    }

    /**
     * @return Client[]
     */
    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    public function findOneByIdOrFail(string $id): ?Client
    {
        if (null === $user = $this->objectRepository->findOneBy(['id' => $id])) {
            throw UserNotFoundException::fromId($id);
        }

        return $user;
    }

    public function findOneByCnpjOrFail(string $cnpj): ?Client
    {
        if (null === $user = $this->objectRepository->findOneBy(['cnpj' => $cnpj])) {
            throw ClientNotFoundException::fromCnpj($cnpj);
        }

        return $user;
    }

//    public function findOneByIdWithQueryBuilder(string $id): ?User
//    {
//        $qb = $this->objectRepository->createQueryBuilder('u');
//        $query = $qb
//            ->where(
//                $qb->expr()->eq('u.id', ':id')
//            )
//            ->setParameter('id', $id)
//            ->getQuery();
//
//        return $query->getOneOrNullResult();
//    }
//
//    public function findOneByIdWithDQL(string $id): ?User
//    {
//        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE u.id = :id');
//        $query->setParameter('id', $id);
//
//        return $query->getOneOrNullResult();
//    }
//
//    /**
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     */
//    public function findOneByEmailAndToken(string $email, string $token): ?User
//    {
//        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE (u.email = :email AND u.token = :token)');
//        $query->setParameter('email', $email);
//        $query->setParameter('token', $token);
//
//        return $query->getOneOrNullResult();
//    }
//
//    public function findOneInactiveByEmailAndTokenOrFail(string $email, string $code): User
//    {
//        if (null === $user = $this->objectRepository->findOneBy(['email' => $email, 'code' => $code, 'isActive' => false])) {
//            throw UserNotFoundException::fromEmailAndToken($email, $code);
//        }
//
//        return $user;
//    }
//
//    public function findOnyByIdWithNativeQuery(string $id): ?User
//    {
//        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
//        $rsm->addRootEntityFromClassMetadata(User::class, 'u');
//
//        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM user WHERE id = :id', $rsm);
//        $query->setParameter('id', $id);
//
//        return $query->getOneOrNullResult();
//    }
//
//    public function findOneByIdWithPlainSQL(string $id): array
//    {
//        $params = [
//            ':id' => $this->getEntityManager()->getConnection()->quote($id),
//        ];
//        $query = 'SELECT * FROM user WHERE id = :id';
//
//        return $this->getEntityManager()->getConnection()->executeQuery(\strtr($query, $params))->fetchAllAssociative();
//    }

    public function save(Client $client): void
    {
        $this->saveEntity($client);
    }

    public function remove(lient $client): void
    {
        $this->removeEntity($client);
    }
}
