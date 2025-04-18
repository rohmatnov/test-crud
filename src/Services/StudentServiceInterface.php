<?php

namespace Rohmat\CrudTest\Services;

interface StudentServiceInterface
{
    public function getAllStudents();

    public function getStudentById(int $id);

    public function createStudent(array $data);

    public function updateStudent(int $id, array $data);

    public function deleteStudent(int $id);

    public function getStudentByProgramId(int $programId);
}
