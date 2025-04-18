<?php

namespace Rohmat\CrudTest\Repositories;

use Rohmat\CrudTest\Dtos\StudentDto;

interface StudentRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findByStudentNumber(string $studentNumber);

    public function findByProgramId(int $programId);

    public function create(StudentDto $student);

    public function update(int $id, StudentDto $student);

    public function delete(int $id);
}
