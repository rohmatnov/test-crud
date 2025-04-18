<?php

namespace Rohmat\CrudTest\Services;

use Rohmat\CrudTest\Dtos\StudentDto;
use Rohmat\CrudTest\Repositories\StudentRepository;

class StudentService implements StudentServiceInterface
{
    public function __construct(
        private StudentRepository $studentRepository = new StudentRepository(),
    ) {}

    public function getAllStudents()
    {
        return $this->studentRepository->all();
    }

    public function getStudentById(int $id)
    {
        return $this->studentRepository->find($id);
    }

    public function createStudent(array $data)
    {
        $student = StudentDto::fromArray($data);

        return $this->studentRepository->create($student);
    }

    public function updateStudent(int $id, array $data)
    {
        $student = StudentDto::fromArray($data);

        return $this->studentRepository->update($id, $student);
    }

    public function deleteStudent(int $id)
    {
        return $this->studentRepository->delete($id);
    }

    public function getStudentByProgramId(int $programId)
    {
        return $this->studentRepository->findByProgramId($programId);
    }
}
