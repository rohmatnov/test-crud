<?php

namespace Rohmat\CrudTest\Validators;

use Rohmat\CrudTest\Repositories\ProgramRepository;
use Rohmat\CrudTest\Validator;

class ProgramValidator extends Validator
{
    private ?int $exceptId = null;

    public function setExceptId(int $exceptId): void
    {
        $this->exceptId = $exceptId;
    }

    protected function rules(): void
    {
        $this->validateName();
        $this->validateCode();
    }

    private function validateName(): void
    {
        $value = $this->getDataByKey('name');
        if (empty($value)) {
            $this->addError('name', 'Nama program studi tidak boleh kosong');
        }

        if (is_string($value) && strlen($value) > 50) {
            $this->addError('name', 'Nama program studi tidak boleh lebih dari 50 karakter');
        }
    }

    private function validateCode(): void
    {
        $value = $this->getDataByKey('code');

        $programRepository = new ProgramRepository();

        if (empty($value)) {
            $this->addError('code', 'Kode program studi tidak boleh kosong');
        }

        if (is_string($value) && strlen($value) > 20) {
            $this->addError('code', 'Kode program studi tidak boleh lebih dari 20 karakter');
        }

        $program = $programRepository->findByCode((string) $value);
        if ($program && ($this->exceptId === null || $program->id !== $this->exceptId)) {
            $this->addError('code', 'Kode program studi sudah terdaftar');
        }
    }
}
