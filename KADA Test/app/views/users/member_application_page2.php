<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Application - Family Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Member Application - Family Information</h2>
    <form action="/member-application/page3" method="POST">
        <div class="mb-3">
            <label for="nama_pewaris" class="form-label">Heir Name</label>
            <input type="text" class="form-control" name="nama_pewaris" id="nama_pewaris" required>
        </div>
        <div class="mb-3">
            <label for="hubungan_pewaris" class="form-label">Relationship</label>
            <input type="text" class="form-control" name="hubungan_pewaris" id="hubungan_pewaris" required>
        </div>
        <div class="mb-3">
            <label for="no_kp_pewaris" class="form-label">Heir No KP</label>
            <input type="text" class="form-control" name="no_kp_pewaris" id="no_kp_pewaris" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Next</button>
    </form>
</div>
</body>
</html>
