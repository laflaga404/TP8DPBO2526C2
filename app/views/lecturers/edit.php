<?php $pageTitle = 'Ubah'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="col-lg-6 m-auto">
  <form method="post"><br><br><div class="card">
    <div class="card-header bg-warning"><h1 class="text-white text-center"> Update Lecturer </h1></div><br>
    <?php if ($error): ?><div class="alert alert-danger mx-3"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <input type="hidden" name="id" value="<?= (int)$lecturer['id'] ?>" class="form-control"> <br>

        <label> NAME: </label>
        <input type="text" name="name" value="<?= htmlspecialchars($lecturer['name'] ?? '') ?>" class="form-control" required> <br>
        <label> NIDN: </label>
        <input type="text" name="nidn" value="<?= htmlspecialchars($lecturer['nidn'] ?? '') ?>" class="form-control" required> <br>
        <label> PHONE: </label>
        <input type="text" name="phone" value="<?= htmlspecialchars($lecturer['phone'] ?? '') ?>" class="form-control" required> <br>
        <label> JOIN DATE: </label>
        <input type="date" name="join_date" value="<?= htmlspecialchars($lecturer['join_date'] ?? '') ?>" class="form-control" required> <br>
        <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
        <a class="btn btn-info" href="?page=lecturers"> Cancel </a><br>
  </div></form>
</div>
<?php require __DIR__ . '/../views/layouts/footer.php'; ?>
