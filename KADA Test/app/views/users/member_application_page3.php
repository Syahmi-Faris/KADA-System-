<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Application - Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Member Application - Payment</h2>
    <form action="/member-application/submit" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fee_masuk" class="form-label">Fee Masuk</label>
            <input type="number" class="form-control" name="fee_masuk" id="fee_masuk" required>
        </div>
        <div class="mb-3">
            <label for="modah_syer" class="form-label">Modal Syer</label>
            <input type="number" class="form-control" name="modah_syer" id="modah_syer" required>
        </div>
        <div class="mb-3">
            <label for="receipt" class="form-label">Upload Payment Receipt</label>
            <input type="file" class="form-control" name="receipt" id="receipt" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Submit Application</button>
    </form>
</div>
</body>
</html>
