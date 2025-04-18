<?php

namespace Rohmat\CrudTest\Services;

interface ProgramServiceInterface
{
    public function getAllPrograms();

    public function getProgramById(int $id);

    public function createProgram(array $data);

    public function updateProgram(int $id, array $data);

    public function deleteProgram(int $id);
}
