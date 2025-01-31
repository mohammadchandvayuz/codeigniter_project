<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <style>
        #crop-container {
            max-width: 100%;
            display: none;
        }
        #crop-image {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Edit User</h2>

    <form action="<?= base_url('/admin/users/update/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="old_image" value="<?= $user['profile_image'] ?>">
        <input type="hidden" name="cropped_image" id="cropped_image"> <!-- Hidden input to store cropped image -->

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= $user['last_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label>New Password (Leave blank if not changing)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Profile Image</label>
            <input type="file" name="profile_image" id="profile_image_input" class="form-control" accept="image/*">
            <br>
            <img id="preview_image" src="<?= base_url('uploads/' . $user['profile_image']) ?>" alt="Profile" width="100">
            <div id="crop-container">
                <canvas id="crop-image"></canvas>
                <button type="button" class="btn btn-success mt-2" id="crop-btn">Crop & Compress</button>
            </div>
        </div>

        <h4>Education Details</h4>
        <div class="mb-3">
            <label>Degree</label>
            <input type="text" name="degree" class="form-control" value="<?= $education['degree'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" value="<?= $education['institution'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Passing Year</label>
            <input type="text" name="passing_year" class="form-control" value="<?= $education['passing_year'] ?? '' ?>">
        </div>

        <h4>Employment Details</h4>
        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="<?= $employment['company_name'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="job_title" class="form-control" value="<?= $employment['job_title'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="<?= $employment['start_date'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="<?= $employment['end_date'] ?? '' ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
    let cropper;
    const profileImageInput = document.getElementById('profile_image_input');
    const previewImage = document.getElementById('preview_image');
    const cropContainer = document.getElementById('crop-container');
    const cropImageCanvas = document.getElementById('crop-image');
    const cropButton = document.getElementById('crop-btn');
    const croppedImageInput = document.getElementById('cropped_image');

    profileImageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                cropContainer.style.display = 'block';

                // Initialize Cropper.js
                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(previewImage, {
                    aspectRatio: 1, // Square crop
                    viewMode: 1
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.addEventListener('click', function () {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                imageSmoothingQuality: 'high'
            });

            // Compress Image
            canvas.toBlob((blob) => {
                const reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    croppedImageInput.value = reader.result; // Store cropped image as base64
                };
            }, 'image/jpeg', 0.7); // Compress to 70% quality

            previewImage.src = canvas.toDataURL();
            cropContainer.style.display = 'none';
        }
    });
</script>

</body>
</html>
