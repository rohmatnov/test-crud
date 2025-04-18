<?php

namespace Rohmat\CrudTest\Repositories;

use Rohmat\CrudTest\Dtos\ProgramDto;

interface ProgramRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findByCode(string $code);

    public function create(ProgramDto $program);

    public function update(int $id, ProgramDto $program);

    public function delete(int $id);
}
