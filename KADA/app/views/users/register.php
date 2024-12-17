<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Register</h2>

                <!-- Display Errors -->
                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form action="/register" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>

                <p class="mt-3 text-center">
                    Already have an account? <a href="/login">Login here</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Success -->
    <?php if (isset($success)): ?>
        <div class="modal fade show" tabindex="-1" role="dialog" style="display:block;" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                    </div>
                    <div class="modal-body">
                        <?= htmlspecialchars($success); ?>
                    </div>
                    <div class="modal-footer">
                        <a href="/login" class="btn btn-primary">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close Modal using JavaScript -->
        <script>
            setTimeout(() => {
                document.querySelector('.modal').style.display = 'none';
            }, 3000); // Close after 3 seconds
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
