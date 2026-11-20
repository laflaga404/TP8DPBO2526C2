<?php

class ClassController
{
    public function __construct(private SchoolClass $model, private Lecturer $lecturers) {}

    public function index(): void
    {
        $classes = $this->model->getAll();
        require __DIR__ . '/../views/classes/index.php';
    }

    public function create(): void
    {
        $lecturers = $this->lecturers->getAll();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$lecturerId, $code, $name, $credits, $semester] = $this->input();
            if (!$lecturerId || $code === '' || $name === '' || $credits < 1 || $semester === '') $error = 'All fields are required and credits must be at least 1.';
            else {
                try { $this->model->create($lecturerId, $code, $name, $credits, $semester); redirect('?page=classes'); }
                catch (mysqli_sql_exception $e) { $error = 'Unable to save class. Check the class code and lecturer.'; }
            }
        }
        require __DIR__ . '/../views/classes/create.php';
    }

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: (int)($_POST['id'] ?? 0);
        $class = $this->model->getById($id);
        if (!$class) { http_response_code(404); exit('Class not found.'); }
        $lecturers = $this->lecturers->getAll();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$lecturerId, $code, $name, $credits, $semester] = $this->input();
            if (!$lecturerId || $code === '' || $name === '' || $credits < 1 || $semester === '') $error = 'All fields are required and credits must be at least 1.';
            else {
                try { $this->model->update($id, $lecturerId, $code, $name, $credits, $semester); redirect('?page=classes'); }
                catch (mysqli_sql_exception $e) { $error = 'Unable to update class. Check the class code and lecturer.'; }
            }
            $class = array_merge($class, ['lecturer_id'=>$lecturerId, 'class_code'=>$code, 'class_name'=>$name, 'credits'=>$credits, 'semester'=>$semester]);
        }
        require __DIR__ . '/../views/classes/edit.php';
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('?page=classes');
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) $this->model->delete($id);
        redirect('?page=classes');
    }

    private function input(): array
    {
        return [(int)($_POST['lecturer_id'] ?? 0), trim($_POST['class_code'] ?? ''), trim($_POST['class_name'] ?? ''), (int)($_POST['credits'] ?? 0), trim($_POST['semester'] ?? '')];
    }
}
