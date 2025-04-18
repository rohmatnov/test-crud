<?php

namespace Rohmat\CrudTest\Controllers;

use Rohmat\CrudTest\Attributes\Route;
use Rohmat\CrudTest\FlashMessage;
use Rohmat\CrudTest\Router;
use Rohmat\CrudTest\Services\ProgramService;
use Rohmat\CrudTest\Services\StudentService;
use Rohmat\CrudTest\Validators\ProgramValidator;
use Rohmat\CrudTest\ViewRenderer;

class ProgramController
{
    public function __construct(
        private ViewRenderer $view = new ViewRenderer(),
        private ProgramService $programService = new ProgramService(),
    ) {
        //
    }

    #[Route(method: 'GET', path: '/')]
    public function index()
    {
        $this->view->render('programs/manage-program-view', [
            'programs' => $this->programService->getAllPrograms(),
        ]);
    }

    #[Route(method: 'GET', path: '/create')]
    public function create()
    {
        $this->view->render('programs/create-program-view');
    }

    #[Route(method: 'POST', path: '/store')]
    public function store()
    {
        $data = $_POST;

        $validator = new ProgramValidator();
        $validator->validate($data);

        if ($validator->hasErrors()) {
            $validator->flashErrors();
            FlashMessage::set('old', $data);

            redirect('/programs/create');
        }

        $this->programService->createProgram($data);

        FlashMessage::set('success', 'Data program berhasil ditambahkan');

        redirect('/programs');
    }

    #[Route(method: 'GET', path: '/edit/:id')]
    public function edit($id)
    {
        $program = $this->programService->getProgramById($id);
        abort_if($program === null);

        $this->view->render('programs/edit-program-view', [
            'program' => $program,
        ]);
    }

    #[Route(method: 'POST', path: '/update/:id')]
    public function update($id)
    {
        $program = $this->programService->getProgramById($id);
        abort_if($program === null);

        $data = $_POST;

        $validator = new ProgramValidator();
        $validator->setExceptId($id);
        $validator->validate($data);

        if ($validator->hasErrors()) {
            $validator->flashErrors();
            FlashMessage::set('old', $data);

            redirect('/programs/edit/' . $id);
        }

        $this->programService->updateProgram($id, $data);

        FlashMessage::set('success', 'Data program berhasil diperbarui');

        redirect('/programs');
    }

    #[Route(method: 'GET', path: '/delete/:id')]
    public function delete($id)
    {
        $program = $this->programService->getProgramById($id);
        abort_if($program === null);

        $student = new StudentService();
        abort_if(count($student->getStudentByProgramId($id)) > 0, 409, 'Data tidak dapat dihapus karena masih terhubung dengan data lain di sistem.');

        $this->programService->deleteProgram($id);

        FlashMessage::set('success', 'Data program berhasil dihapus');

        redirect('/programs');
    }
}
