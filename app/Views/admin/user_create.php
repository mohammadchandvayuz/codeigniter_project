<?php 
    $staticText = new \App\Libraries\StaticText();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $staticText->getPageTitle('add_new_user') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2><?= $staticText->getPageTitle('add_new_user') ?></h2>

    <form action="<?= base_url('/admin/users/store') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- First Column for Personal Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('first_name') ?></label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
            </div>
            
            <!-- Second Column for Personal Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('last_name') ?></label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
            </div>

            <!-- First Row of Personal Info Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('email') ?></label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>

            <!-- Second Row of Personal Info Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('password') ?></label>
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>

            <!-- First Column for Profile Image -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('profile_image') ?></label>
                    <input type="file" class="form-control" name="profile_image" accept="image/*">
                </div>
            </div>

            <!-- Second Column for Degree and Institution -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('degree') ?></label>
                    <input type="text" class="form-control" name="degree">
                </div>
            </div>

            <!-- First Row of Education Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('institution') ?></label>
                    <input type="text" class="form-control" name="institution">
                </div>
            </div>

            <!-- Second Row of Education Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('passing_year') ?></label>
                    <input type="number" class="form-control" name="passing_year">
                </div>
            </div>

            <!-- First Column for Employment Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('company_name') ?></label>
                    <input type="text" class="form-control" name="company_name">
                </div>
            </div>

            <!-- Second Column for Employment Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('job_title') ?></label>
                    <input type="text" class="form-control" name="job_title">
                </div>
            </div>

            <!-- First Row of Employment Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('start_date') ?></label>
                    <input type="date" class="form-control" name="start_date">
                </div>
            </div>

            <!-- Second Row of Employment Fields -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"><?= $staticText->getAddNewUserText('end_date') ?></label>
                    <input type="date" class="form-control" name="end_date">
                </div>
            </div>

        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success"><?= $staticText->getButtonText('create_user') ?></button>
    </form>

    <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary mt-3"><?= $staticText->getButtonText('back_to_user_list') ?></a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
