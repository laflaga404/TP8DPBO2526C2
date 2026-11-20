<?php $pageTitle = 'Create Class'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="col-lg-6 m-auto"><form method="post"><br><br><div class="card">
<div class="card-header bg-primary"><h1 class="text-white text-center"> Create Class</h1></div><br>
<?php if ($error): ?><div class="alert alert-danger mx-3"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<label> LECTURER: </label>
<select name="lecturer_id" class="form-control" required><option value="">Select Lecturer</option>
<?php foreach ($lecturers as $lecturerOption): ?><option value="<?= (int)$lecturerOption['id'] ?>" <?= (int)($class['lecturer_id'] ?? 0) === (int)$lecturerOption['id'] ? 'selected' : '' ?>><?= htmlspecialchars($lecturerOption['name']) ?></option><?php endforeach; ?>
</select><br>
<label> CLASS CODE: </label><input type="text" name="class_code" value="<?= htmlspecialchars($class['class_code'] ?? '') ?>" class="form-control" required><br>
<label> CLASS NAME: </label><input type="text" name="class_name" value="<?= htmlspecialchars($class['class_name'] ?? '') ?>" class="form-control" required><br>
<label> CREDITS: </label><input type="number" min="1" name="credits" value="<?= htmlspecialchars((string)($class['credits'] ?? '')) ?>" class="form-control" required><br>
<label> SEMESTER: </label><input type="text" name="semester" value="<?= htmlspecialchars($class['semester'] ?? '') ?>" class="form-control" required><br>
<button class="btn btn-success" type="submit" name="submit">Submit</button><br><a class="btn btn-info" href="?page=classes">Cancel</a><br>
</div></form></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
