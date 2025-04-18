<?php

namespace Rohmat\CrudTest\Dtos;

class ProgramDto
{
    public function __construct(
        public string $name,
        public string $code,
        public ?int $id = null
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            code: $data['code'],
        );
    }
}
