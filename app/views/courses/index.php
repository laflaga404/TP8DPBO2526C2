<?php function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); } ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="public/assets/bootstrap.min.css" rel="stylesheet">
  <title>Courses</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Lecturers</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=courses">?</a></li>
          <li class="nav-item"><a class="nav-link" href="">?</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container my-4">
    <div class="col-1 my-3">
      <a type="button" class="btn btn-primary nav-link active" href="index.php?page=courses&action=create">Add New</a>
    </div>
    <table class="table">
      <thead><tr><th>ID</th><th>COURSE CODE</th><th>COURSE NAME</th><th>CREDITS</th><th>SEMESTER</th><th>LECTURER</th><th>ACTIONS</th></tr></thead>
      <tbody>
        <?php foreach ($courses as $row): ?>
          <tr><th><?= e($row['id']) ?></th><td><?= e($row['course_code']) ?></td><td><?= e($row['course_name']) ?></td><td><?= e($row['credits']) ?></td><td><?= e($row['semester']) ?></td><td><?= e($row['lecturer_name']) ?></td>
          <td><a class="btn btn-success" href="index.php?page=courses&action=edit&id=<?= e($row['id']) ?>">Edit</a>
          <a class="btn btn-danger" href="index.php?page=courses&action=delete&id=<?= e($row['id']) ?>" onclick="return confirm('Delete this course?')">Delete</a></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="public/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
