<?php

namespace Rohmat\CrudTest\Dtos;

class StudentDto
{
    public function __construct(
        public string $name,
        public string $studentNumber,
        public string $phoneNumber,
        public ?int $programId = null,
        public ?int $id = null,
        public ?ProgramDto $program = null,
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            program: $data['program'] ?? null,
            name: $data['name'],
            studentNumber: $data['student_number'],
            phoneNumber: $data['phone_number'],
            programId: $data['program_id'] ?? null,
        );
    }
}
