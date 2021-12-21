<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Employee;
use App\Exception\Employee\EmployeeNotFoundException;

class DoctrineEmployeeRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Employee::class;
    }

    /**
     * @return Employee[]
     */
    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    public function findOneByCpf(string $cpf): ?Employee
    {
        return $this->objectRepository->findOneBy(['cpf' => $cpf]);
    }

    public function findOneByIdOrFail(string $id): ?Employee
    {
        if (null === $employee = $this->objectRepository->findOneBy(['id' => $id])) {
            throw EmployeeNotFoundException::fromId($id);
        }

        return $employee;
    }

    public function save(Employee $employee): void
    {
        $this->saveEntity($employee);
    }

    public function remove(Employee $employee): void
    {
        $this->removeEntity($employee);
    }
}
