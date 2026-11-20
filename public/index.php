<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Lecturer.php';
require_once __DIR__ . '/../app/models/SchoolClass.php';
require_once __DIR__ . '/../app/controllers/LecturerController.php';
require_once __DIR__ . '/../app/controllers/ClassController.php';

function redirect(string $url): never { header('Location: ' . $url); exit; }

$lecturerModel = new Lecturer($db);
$classModel = new SchoolClass($db);
$lecturerController = new LecturerController($lecturerModel);
$classController = new ClassController($classModel, $lecturerModel);

$page = $_GET['page'] ?? 'lecturers';
$action = $_GET['action'] ?? 'index';

if ($page === 'classes') {
    match ($action) {
        'create' => $classController->create(),
        'edit' => $classController->edit(),
        'delete' => $classController->delete(),
        default => $classController->index(),
    };
} else {
    match ($action) {
        'create' => $lecturerController->create(),
        'edit' => $lecturerController->edit(),
        'delete' => $lecturerController->delete(),
        default => $lecturerController->index(),
    };
}
