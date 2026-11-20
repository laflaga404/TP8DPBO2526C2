<?php
$pageTitle = $pageTitle ?? 'Home';
$currentPage = $_GET['page'] ?? 'lecturers';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
  <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="?page=lecturers">Lecturers</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'lecturers' ? 'active' : '' ?>" aria-current="page" href="?page=lecturers">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'classes' ? 'active' : '' ?>" href="?page=classes">Classes</a></li>
        </ul>
      </div>
    </div>
  </nav>
