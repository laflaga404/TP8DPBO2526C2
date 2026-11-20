<?php

class LecturerController
{
    public function __construct(private Lecturer $model) {}

    public function index(): void
    {
        $lecturers = $this->model->getAll();
        require __DIR__ . '/../views/lecturers/index.php';
    }

    public function create(): void
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $nidn = trim($_POST['nidn'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $joinDate = trim($_POST['join_date'] ?? '');
            if ($name === '' || $nidn === '' || $phone === '' || $joinDate === '') {
                $error = 'All fields are required.';
            } else {
                try {
                    $this->model->create($name, $nidn, $phone, $joinDate);
                    redirect('?page=lecturers');
                } catch (mysqli_sql_exception $e) {
                    $error = 'Unable to save lecturer. Check that the NIDN is not already used.';
                }
            }
        }
        require __DIR__ . '/../views/lecturers/create.php';
    }

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: (int)($_POST['id'] ?? 0);
        $lecturer = $this->model->getById($id);
        if (!$lecturer) { http_response_code(404); exit('Lecturer not found.'); }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $nidn = trim($_POST['nidn'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $joinDate = trim($_POST['join_date'] ?? '');
            if ($name === '' || $nidn === '' || $phone === '' || $joinDate === '') {
                $error = 'All fields are required.';
            } else {
                try {
                    $this->model->update($id, $name, $nidn, $phone, $joinDate);
                    redirect('?page=lecturers');
                } catch (mysqli_sql_exception $e) {
                    $error = 'Unable to update lecturer. Check that the NIDN is not already used.';
                }
            }
            $lecturer = array_merge($lecturer, ['name'=>$name, 'nidn'=>$nidn, 'phone'=>$phone, 'join_date'=>$joinDate]);
        }
        require __DIR__ . '/../views/lecturers/edit.php';
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { redirect('?page=lecturers'); }
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            try { $this->model->delete($id); }
            catch (mysqli_sql_exception $e) { $_SESSION['flash'] = 'Lecturer cannot be deleted while classes are assigned to them.'; }
        }
        redirect('?page=lecturers');
    }
}
