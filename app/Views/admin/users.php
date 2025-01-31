<?php 
    $staticText = new \App\Libraries\StaticText();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $staticText->getPageTitle('user_management') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2><?= $staticText->getPageTitle('user_management') ?></h2>
    <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-success mb-3"><?= $staticText->getButtonText('add_new_user') ?></a>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th><?= $staticText->getTableHeader('profile_image') ?></th>
                <th><?= $staticText->getTableHeader('name') ?></th>
                <th><?= $staticText->getTableHeader('email') ?></th>
                <th><?= $staticText->getTableHeader('role') ?></th>
                <th><?= $staticText->getTableHeader('actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td>
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="<?= base_url('uploads/' . $user['profile_image']) ?>" alt="Profile" width="50" height="50" class="rounded-circle">
                        <?php else: ?>
                            <img src="<?= base_url('uploads/default.png') ?>" alt="Default" width="50" height="50" class="rounded-circle">
                        <?php endif; ?>
                    </td>
                    <td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <span class="badge <?= $staticText->getBadgeColor($user['role']) ?>">
                            <?= ucfirst($user['role']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('/admin/users/view/' . $user['id']) ?>" class="btn btn-info btn-sm"><?= $staticText->getTableRowData('view') ?></a>
                        <a href="<?= base_url('/admin/users/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm"><?= $staticText->getTableRowData('edit') ?></a>
                        <a href="<?= base_url('/admin/users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?= $staticText->getConfirmationMessage() ?>')"><?= $staticText->getTableRowData('delete') ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-secondary"><?= $staticText->getButtonText('back_to_dashboard') ?></a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
