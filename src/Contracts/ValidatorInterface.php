<?php

namespace Rohmat\CrudTest\Contracts;

interface ValidatorInterface
{
    public function validate(array $data): void;
    public function getErrors(): array;
}
