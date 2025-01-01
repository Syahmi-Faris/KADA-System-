<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA COOPERATIVE GENERAL WEBSITE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">KADA COOPERATIVE GENERAL WEBSITE</h1>
        <hr>
        <h3 class="text-center mb-4">Accepted Member Applications</h3>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>No KP</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($applications)): ?>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app['nama']); ?></td>
                            <td><?= htmlspecialchars($app['no_kp']); ?></td>
                            <td><?= htmlspecialchars($app['alamat_rumah']); ?></td>
                            <td><?= htmlspecialchars($app['no_tel_bimbit']); ?></td>
                            <td><span class="badge bg-success"><?= htmlspecialchars($app['status']); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No accepted applications available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
