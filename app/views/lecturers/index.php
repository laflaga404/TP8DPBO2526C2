<?php $pageTitle = 'Home'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="container my-4">
  <div class="col-1 my-3">
    <a type="button" class="btn btn-primary nav-link active" href="?page=lecturers&action=create">Add New</a>
  </div>
  <?php if (!empty($_SESSION['flash'])): ?><div class="alert alert-warning"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div><?php endif; ?>
  <table class="table">
    <thead><tr><th>ID</th><th>NAME</th><th>NIDN</th><th>PHONE</th><th>JOIN DATE</th><th>ACTIONS</th></tr></thead>
    <tbody>
    <?php foreach ($lecturers as $row): ?>
      <tr>
        <th><?= (int)$row['id'] ?></th><td><?= htmlspecialchars($row['name']) ?></td><td><?= htmlspecialchars($row['nidn']) ?></td><td><?= htmlspecialchars($row['phone']) ?></td><td><?= htmlspecialchars($row['join_date']) ?></td>
        <td><a class="btn btn-success" href="?page=lecturers&action=edit&id=<?= (int)$row['id'] ?>">Edit</a>
          <form method="post" action="?page=lecturers&action=delete" style="display:inline" onsubmit="return confirm('Delete this lecturer?')"><input type="hidden" name="id" value="<?= (int)$row['id'] ?>"><button class="btn btn-danger" type="submit">Delete</button></form></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
