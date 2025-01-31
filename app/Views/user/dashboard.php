<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?= $user['first_name'] ?>!</h2>
    <p>Your last login was on: <?= $user['created_at'] ?></p>
</div>

</body>
</html>
