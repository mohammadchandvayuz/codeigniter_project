<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet">
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
        }
        .user-details {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">User Details</h2>

    <div class="profile-container">
        <img src="<?= base_url('uploads/' . ($user['profile_image'] ?? 'default.png')) ?>" class="profile-image" alt="Profile">
        <h4 class="mt-3"><?= $user['first_name'] . ' ' . $user['last_name'] ?></h4>
        <p class="text-muted"><?= ucfirst($user['role']) ?></p>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Personal Information</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Email</th>
                    <td><?= $user['email'] ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><span class="badge <?= $user['role'] == 'admin' ? 'bg-danger' : 'bg-primary' ?>"><?= ucfirst($user['role']) ?></span></td>
                </tr>
            </table>

            <h5 class="mt-4">Education Details</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Passing Year</th>
                </tr>
                <tr>
                    <td><?= $education['degree'] ?? 'N/A' ?></td>
                    <td><?= $education['institution'] ?? 'N/A' ?></td>
                    <td><?= $education['passing_year'] ?? 'N/A' ?></td>
                </tr>
            </table>

            <h5 class="mt-4">Employment Details</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Company Name</th>
                    <th>Job Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                <tr>
                    <td><?= $employment['company_name'] ?? 'N/A' ?></td>
                    <td><?= $employment['job_title'] ?? 'N/A' ?></td>
                    <td><?= $employment['start_date'] ?? 'N/A' ?></td>
                    <td><?= $employment['end_date'] ?? 'N/A' ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary">Back to Users</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
