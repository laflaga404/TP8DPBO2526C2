<?php function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); } ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="public/assets/bootstrap.min.css" rel="stylesheet">
  <title>Update Course</title>
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
  <div class="col-lg-6 m-auto">
    <form method="post"><br><br><div class="card">
      <div class="card-header bg-warning"><h1 class="text-white text-center"> Update Course</h1></div><br>
<input type="hidden" name="id" value="<?= e($course['id']) ?>"> <br>
        <label> COURSE CODE: </label>
        <input type="text" name="course_code" value="<?= e($course['course_code'] ?? '') ?>" class="form-control" required> <br>
        <label> COURSE NAME: </label>
        <input type="text" name="course_name" value="<?= e($course['course_name'] ?? '') ?>" class="form-control" required> <br>
        <label> CREDITS: </label>
        <input type="number" name="credits" min="1" max="20" value="<?= e($course['credits'] ?? '3') ?>" class="form-control" required> <br>
        <label> SEMESTER: </label>
        <input type="text" name="semester" value="<?= e($course['semester'] ?? '') ?>" class="form-control" required> <br>
        <label> LECTURER: </label>
        <select name="lecturer_id" class="form-control" required>
          <option value="">Select Lecturer</option>
          <?php foreach ($lecturers as $lecturerOption): ?>
            <option value="<?= e($lecturerOption['id']) ?>" <?= (string)($course['lecturer_id'] ?? '') === (string)$lecturerOption['id'] ? 'selected' : '' ?>><?= e($lecturerOption['name']) ?></option>
          <?php endforeach; ?>
        </select> <br>
      <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
      <a class="btn btn-info" href="index.php?page=courses"> Cancel </a><br>
    </div></form>
  </div>
  <script src="public/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
