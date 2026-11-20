<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <strong>Periksa kembali input berikut:</strong>
        <ul class="mb-0 mt-2">
            <?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
