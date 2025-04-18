<?php

namespace Rohmat\CrudTest;

use Rohmat\CrudTest\Contracts\ValidatorInterface;

class Validator implements ValidatorInterface
{
    private array $errors = [];

    private array $data = [];

    final public function validate(array $data): void
    {
        $this->data = $data;
        $this->errors = [];

        $this->rules();
    }

    final protected function addError(string $key, string $message): void
    {
        $this->errors[$key][] = $message;
    }

    final protected function getError(string $key, int $index = 0): ?string
    {
        return $this->errors[$key][$index] ?? null;
    }


    final public function getErrors(): array
    {
        return $this->errors;
    }

    final public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    final public function getData(): array
    {
        return $this->data;
    }

    final public function getDataByKey(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    final public function flashErrors(): void
    {
        if ($this->hasErrors()) {
            FlashMessage::set('errors', $this->errors);
        }
    }

    protected function rules(): void
    {
        // Implement validation rules in subclasses
    }
}
