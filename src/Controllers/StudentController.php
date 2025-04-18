<?php

namespace Rohmat\CrudTest\Controllers;

use Rohmat\CrudTest\Attributes\Route;
use Rohmat\CrudTest\FlashMessage;
use Rohmat\CrudTest\Services\ProgramService;
use Rohmat\CrudTest\Services\StudentService;
use Rohmat\CrudTest\Validators\StudentValidator;
use Rohmat\CrudTest\ViewRenderer;

class StudentController
{
    public function __construct(
        private ViewRenderer $view = new ViewRenderer(),
        private StudentService $studentService = new StudentService(),
        private ProgramService $programService = new ProgramService(),
    ) {
        //
    }


    #[Route(method: 'GET', path: '/')]
    public function index()
    {
        $this->view->render('students/manage-student-view', [
            'students' => $this->studentService->getAllStudents(),
        ]);
    }

    #[Route(method: 'GET', path: '/show/:id')]
    public function show($id)
    {
        $student = $this->studentService->getStudentById($id);
        abort_if($student === null);

        $this->view->render('students/detail-student-view', [
            'student' => $student
        ]);
    }

    #[Route(method: 'GET', path: '/create')]
    public function create()
    {
        $programs = $this->programService->getAllPrograms();

        $this->view->render('students/create-student-view', [
            'programs' => $programs,
        ]);
    }

    #[Route(method: 'POST', path: '/store')]
    public function store()
    {
        $data = $_POST;

        $validator = new StudentValidator();
        $validator->validate($data);

        if ($validator->hasErrors()) {
            $validator->flashErrors();
            FlashMessage::set('old', $data);

            redirect('/create');
        }

        $this->studentService->createStudent($data);

        FlashMessage::set('success', 'Data mahasiswa berhasil ditambahkan');

        redirect('/');
    }

    #[Route(method: 'GET', path: '/edit/:id')]
    public function edit($id)
    {
        $student = $this->studentService->getStudentById($id);
        abort_if($student === null);

        $programs = $this->programService->getAllPrograms();

        $this->view->render('students/edit-student-view', [
            'student' => $student,
            'programs' => $programs,
        ]);
    }

    #[Route(method: 'POST', path: '/update/:id')]
    public function update($id)
    {
        $student = $this->studentService->getStudentById($id);
        abort_if($student === null);

        $data = $_POST;

        $validator = new StudentValidator();
        $validator->setExceptId($id);
        $validator->validate($data);

        if ($validator->hasErrors()) {
            $validator->flashErrors();
            FlashMessage::set('old', $data);

            redirect('/edit/' . $id);
        }

        $this->studentService->updateStudent($id, $data);

        FlashMessage::set('success', 'Data mahasiswa berhasil diperbarui');

        redirect('/');
    }

    #[Route(method: 'GET', path: '/delete/:id')]
    public function delete($id)
    {
        $student = $this->studentService->getStudentById($id);
        abort_if($student === null);

        $this->studentService->deleteStudent($id);

        FlashMessage::set('success', 'Data mahasiswa berhasil dihapus');

        redirect('/');
    }
}
