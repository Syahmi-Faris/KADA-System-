<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white text-center">
                        <h2 class="mb-0">Edit User</h2>
                    </div>
                    <div class="card-body">
                        <form action="/update/<?= $user['id']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" 
                                       value="<?= htmlspecialchars($user['username']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" 
                                       value="<?= htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-warning">Update User</button>
                            </div>
                        </form>
                        <!-- Back to Main Page Button -->
                        <div class="d-grid">
                            <a href="/" class="btn btn-secondary">Back to Main Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
