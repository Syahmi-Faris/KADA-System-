<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Application - Personal Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Member Application - Personal Information</h2>
    <form action="/member-application/page2" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="no_kp" class="form-label">No KP</label>
            <input type="text" class="form-control" name="no_kp" id="no_kp" required>
        </div>
        <div class="mb-3">
            <label for="jantina" class="form-label">Gender</label>
            <select class="form-select" name="jantina" id="jantina" required>
                <option value="Lelaki">Lelaki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="agama" class="form-label">Religion</label>
            <input type="text" class="form-control" name="agama" id="agama" required>
        </div>
        <div class="mb-3">
            <label for="bangsa" class="form-label">Race</label>
            <input type="text" class="form-control" name="bangsa" id="bangsa" required>
        </div>
        <div class="mb-3">
            <label for="alamat_rumah" class="form-label">Home Address</label>
            <textarea class="form-control" name="alamat_rumah" id="alamat_rumah" rows="3" required></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="poskod" class="form-label">Postcode</label>
                <input type="text" class="form-control" name="poskod" id="poskod" required>
            </div>
            <div class="col">
                <label for="negeri" class="form-label">State</label>
                <input type="text" class="form-control" name="negeri" id="negeri" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="no_tel_bimbit" class="form-label">Mobile Phone</label>
                <input type="text" class="form-control" name="no_tel_bimbit" id="no_tel_bimbit" required>
            </div>
            <div class="col">
                <label for="no_tel_rumah" class="form-label">Home Phone</label>
                <input type="text" class="form-control" name="no_tel_rumah" id="no_tel_rumah" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="gaji_bulanan" class="form-label">Monthly Salary</label>
            <input type="number" class="form-control" name="gaji_bulanan" id="gaji_bulanan" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Next</button>
    </form>
</div>
</body>
</html>
