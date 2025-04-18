<?php

namespace Rohmat\CrudTest\Services;

use Rohmat\CrudTest\Dtos\ProgramDto;
use Rohmat\CrudTest\Repositories\ProgramRepository;

class ProgramService implements ProgramServiceInterface
{
    public function __construct(
        private ProgramRepository $programRepository = new ProgramRepository(),
    ) {}

    public function getAllPrograms()
    {
        return $this->programRepository->all();
    }

    public function getProgramById(int $id)
    {
        return $this->programRepository->find($id);
    }

    public function createProgram(array $data)
    {
        $program = ProgramDto::fromArray($data);

        return $this->programRepository->create($program);
    }

    public function updateProgram(int $id, array $data)
    {
        $program = ProgramDto::fromArray($data);

        return $this->programRepository->update($id, $program);
    }

    public function deleteProgram(int $id)
    {
        return $this->programRepository->delete($id);
    }
}
