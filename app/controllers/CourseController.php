<?php

class CourseController
{
    private Course $model;
    private Lecturer $lecturerModel;

    public function __construct(Course $model, Lecturer $lecturerModel)
    {
        $this->model = $model;
        $this->lecturerModel = $lecturerModel;
    }

    public function index(): void
    {
        $courses = $this->model->getAll();
        require __DIR__ . '/../views/courses/index.php';
    }

    public function create(): void
    {
        $lecturers = $this->lecturerModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create(
                (int)($_POST['lecturer_id'] ?? 0),
                trim($_POST['course_code'] ?? ''),
                trim($_POST['course_name'] ?? ''),
                (int)($_POST['credits'] ?? 0),
                trim($_POST['semester'] ?? '')
            );
            header('Location: index.php?page=courses');
            exit;
        }
        require __DIR__ . '/../views/courses/create.php';
    }

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) { header('Location: index.php?page=courses'); exit; }
        $course = $this->model->getById($id);
        if (!$course) { header('Location: index.php?page=courses'); exit; }
        $lecturers = $this->lecturerModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update(
                (int)($_POST['id'] ?? 0),
                (int)($_POST['lecturer_id'] ?? 0),
                trim($_POST['course_code'] ?? ''),
                trim($_POST['course_name'] ?? ''),
                (int)($_POST['credits'] ?? 0),
                trim($_POST['semester'] ?? '')
            );
            header('Location: index.php?page=courses');
            exit;
        }
        require __DIR__ . '/../views/courses/edit.php';
    }

    public function delete(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) { $this->model->delete($id); }
        header('Location: index.php?page=courses');
        exit;
    }
}
