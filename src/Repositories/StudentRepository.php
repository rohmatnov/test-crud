<?php

namespace Rohmat\CrudTest\Repositories;

use mysqli;
use Rohmat\CrudTest\Database;
use Rohmat\CrudTest\Dtos\ProgramDto;
use Rohmat\CrudTest\Dtos\StudentDto;

class StudentRepository implements StudentRepositoryInterface
{
    protected mysqli $database;

    public function __construct()
    {
        $this->database = Database::getConnection();
    }

    public function all()
    {
        $query = "SELECT students.*, programs.name as program_name, programs.code as program_code
            FROM students
            LEFT JOIN programs ON students.program_id = programs.id
            ORDER BY students.id DESC";

        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $results = $stmt->get_result();
        $stmt->close();

        $students = [];
        while ($row = $results->fetch_object()) {
            $students[] = $this->toDtoWithProgram($row);
        }

        return $students;
    }

    public function findByProgramId(int $programId)
    {
        $query = "SELECT students.*, programs.name as program_name, programs.code as program_code
                FROM students
                LEFT JOIN programs ON students.program_id = programs.id
                WHERE students.program_id = ?
                ORDER BY students.id DESC";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $programId);
        $stmt->execute();
        $results = $stmt->get_result();
        $stmt->close();

        $students = [];
        while ($row = $results->fetch_object()) {
            $students[] = $this->toDtoWithProgram($row);
        }

        return $students;
    }

    public function find(int $id)
    {
        $query = "SELECT students.*, programs.name as program_name, programs.code as program_code
                FROM students
                LEFT JOIN programs ON students.program_id = programs.id
                WHERE students.id = ?
                LIMIT 1";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_object();

        return $this->toDtoWithProgram($row);
    }

    public function findByStudentNumber(string $studentNumber)
    {
        $query = "SELECT students.*, programs.name as program_name, programs.code as program_code
                FROM students
                LEFT JOIN programs ON students.program_id = programs.id
                WHERE students.student_number = ?
                LIMIT 1";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $studentNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_object();

        return $this->toDtoWithProgram($row);
    }

    public function create(StudentDto $student)
    {
        $query = "INSERT INTO students (student_number, name, phone_number, program_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssss", $student->studentNumber, $student->name, $student->phoneNumber, $student->programId);
        $stmt->execute();
        $stmt->close();

        return $this->database->insert_id;
    }

    public function update(int $id, StudentDto $student)
    {
        $query = "UPDATE students SET student_number = ?, name = ?, phone_number = ?, program_id = ? WHERE id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssi", $student->studentNumber, $student->name, $student->phoneNumber, $student->programId, $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM students WHERE id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    private function toDtoWithProgram($row): StudentDto
    {
        return new StudentDto(
            id: $row->id,
            name: $row->name,
            studentNumber: $row->student_number,
            phoneNumber: $row->phone_number,
            programId: $row->program_id,
            program: new ProgramDto(
                id: $row->program_id,
                name: $row->program_name,
                code: $row->program_code,
            ),
        );
    }
}
