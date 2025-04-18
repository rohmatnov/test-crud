<?php

namespace Rohmat\CrudTest\Repositories;

use mysqli;
use Rohmat\CrudTest\Database;
use Rohmat\CrudTest\Dtos\ProgramDto;

class ProgramRepository implements ProgramRepositoryInterface
{
    protected mysqli $database;

    public function __construct()
    {
        $this->database = Database::getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM programs";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $results = $stmt->get_result();
        $stmt->close();

        $programs = [];
        while ($row = $results->fetch_object()) {
            $programs[] = $this->toDto($row);
        }

        return $programs;
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM programs WHERE id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_object();

        return $this->toDto($row);
    }

    public function findByCode(string $code)
    {
        $query = "SELECT * FROM programs WHERE code = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_object();

        return $this->toDto($row);
    }

    public function create(ProgramDto $program)
    {
        $query = "INSERT INTO programs (name, code) VALUES (?, ?)";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $program->name, $program->code);
        $stmt->execute();
        $stmt->close();

        return $this->database->insert_id;
    }

    public function update(int $id, ProgramDto $program)
    {
        $query = "UPDATE programs SET name = ?, code = ? WHERE id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssi", $program->name, $program->code, $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM programs WHERE id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }


    private function toDto($row): ProgramDto
    {
        return new ProgramDto(
            id: $row->id,
            name: $row->name,
            code: $row->code,
        );
    }
}
