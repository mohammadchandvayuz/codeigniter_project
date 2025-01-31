<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('/register') ?>" method="post" enctype="multipart/form-data">
                        <h5>Personal Information</h5>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" id="profile_image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="role">
                                <option value="customer">Customer</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <!-- Show Education Details and Employment Details if role is customer -->
                        <div class="role-details" id="role-details" style="display:none;">
                            <h5>Education Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Degree</label>
                                <input type="text" class="form-control" name="degree">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Institution</label>
                                <input type="text" class="form-control" name="institution">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Passing Year</label>
                                <input type="number" class="form-control" name="passing_year">
                            </div>

                            <h5>Employment Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="job_title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show education and employment fields if user is a customer
    document.querySelector('select[name="role"]').addEventListener('change', function() {
        var roleDetails = document.getElementById('role-details');
        if (this.value === 'customer') {
            roleDetails.style.display = 'block';
        } else {
            roleDetails.style.display = 'none';
        }
    });

    // Trigger the change event to show fields by default if the role is customer
    document.querySelector('select[name="role"]').dispatchEvent(new Event('change'));
</script>

</body>
</html>
