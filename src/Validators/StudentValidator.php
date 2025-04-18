<?php

namespace Rohmat\CrudTest\Validators;

use Rohmat\CrudTest\Repositories\StudentRepository;
use Rohmat\CrudTest\Validator;

class StudentValidator extends Validator
{
    private ?int $exceptId = null;

    public function setExceptId(int $exceptId): void
    {
        $this->exceptId = $exceptId;
    }

    protected function rules(): void
    {
        $this->validateName();
        $this->validateStudentNumber();
        $this->validatePhoneNumber();
        $this->validateProgramId();
    }

    private function validateName(): void
    {
        $value = $this->getDataByKey('name');

        if (empty($value)) {
            $this->addError('name', 'Nama tidak boleh kosong');
        }

        if (is_string($value) && strlen($value) > 50) {
            $this->addError('name', 'Nama tidak boleh lebih dari 50 karakter');
        }
    }

    private function validateStudentNumber(): void
    {
        $value = $this->getDataByKey('student_number');

        $studentRepository = new StudentRepository();

        if (empty($value)) {
            $this->addError('student_number', 'Nomor Induk Mahasiswa tidak boleh kosong');
        }

        if (is_string($value) && strlen($value) > 20) {
            $this->addError('student_number', 'Nomor Induk Mahasiswa tidak boleh lebih dari 20 karakter');
        }

        $student = $studentRepository->findByStudentNumber((string) $value);
        if ($student && ($this->exceptId === null || $student->id !== $this->exceptId)) {
            $this->addError('student_number', 'Nomor Induk Mahasiswa sudah terdaftar');
        }
    }

    private function validatePhoneNumber(): void
    {
        $value = $this->getDataByKey('phone_number');

        if (empty($value)) {
            $this->addError('phone_number', 'Nomor telepon tidak boleh kosong');
        }

        if (is_string($value) && !preg_match('/^\d{10,15}$/', $value)) {
            $this->addError('phone_number', 'Nomor telepon tidak valid');
        }
    }

    private function validateProgramId(): void
    {
        $value = $this->getDataByKey('program_id');

        if (empty($value)) {
            $this->addError('program_id', 'Program studi tidak boleh kosong');
        }
    }
}
