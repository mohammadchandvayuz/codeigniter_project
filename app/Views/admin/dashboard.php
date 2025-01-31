<?php 
    $staticText = new \App\Libraries\StaticText();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $staticText->getPageTitle('admin_dashboard') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2><?= $staticText->getAdminDashboardText('welcome_message') ?></h2>
    <p><?= $staticText->getAdminDashboardText('total_users') ?> <strong><?= $total_users ?></strong></p>

    <h5><?= $staticText->getAdminDashboardText('last_registered_users') ?></h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th><?= $staticText->getTableHeader('name') ?></th>
                <th><?= $staticText->getTableHeader('email') ?></th>
                <th><?= $staticText->getTableHeader('registered_at') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach ($last_users as $user): ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= date('d M Y, H:i', strtotime($user['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('/admin/users') ?>" class="btn btn-primary"><?= $staticText->getButtonText('manage_users') ?></a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
