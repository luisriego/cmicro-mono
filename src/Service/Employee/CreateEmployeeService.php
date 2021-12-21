<?php

namespace App\Service\Employee;

use App\Entity\Employee;
use App\Entity\User;
use App\Exception\Employee\EmployeeAlreadyExistsException;
use App\Repository\DoctrineEmployeeRepository;
use Doctrine\ORM\ORMException;

class CreateEmployeeService
{
    public function __construct(private DoctrineEmployeeRepository $employeeRepo)
    { }

    public function __invoke(string $cpf, User $user): Employee
    {
        if ($this->employeeRepo->findOneByCpf($cpf)) {
            throw EmployeeAlreadyExistsException::fromCpf($cpf);
        }

        $employee = new Employee($cpf, $user);

        try {
            $this->employeeRepo->save($employee);
        } catch (ORMException $e) {
            throw EmployeeAlreadyExistsException::fromCpf($cpf);
        }

        return $employee;
    }
}
