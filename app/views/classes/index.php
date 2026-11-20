<?php $pageTitle = 'Classes'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="container my-4">
  <div class="col-1 my-3"><a type="button" class="btn btn-primary nav-link active" href="?page=classes&action=create">Add New</a></div>
  <table class="table">
    <thead><tr><th>ID</th><th>CLASS CODE</th><th>CLASS NAME</th><th>LECTURER</th><th>CREDITS</th><th>SEMESTER</th><th>ACTIONS</th></tr></thead>
    <tbody><?php foreach ($classes as $row): ?><tr>
      <th><?= (int)$row['id'] ?></th><td><?= htmlspecialchars($row['class_code']) ?></td><td><?= htmlspecialchars($row['class_name']) ?></td><td><?= htmlspecialchars($row['lecturer_name']) ?></td><td><?= (int)$row['credits'] ?></td><td><?= htmlspecialchars($row['semester']) ?></td>
      <td><a class="btn btn-success" href="?page=classes&action=edit&id=<?= (int)$row['id'] ?>">Edit</a>
      <form method="post" action="?page=classes&action=delete" style="display:inline" onsubmit="return confirm('Delete this class?')"><input type="hidden" name="id" value="<?= (int)$row['id'] ?>"><button class="btn btn-danger" type="submit">Delete</button></form></td>
    </tr><?php endforeach; ?></tbody>
  </table>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
