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
        <h3 class="text-center mb-4">Member Applications</h3>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>No KP</th>
                    <th>Jantina</th>
                    <th>Agama</th>
                    <th>Bangsa</th>
                    <th>Fee Masuk</th>
                    <th>Modah Syer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($applications)): ?>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app['nama']); ?></td>
                            <td><?= htmlspecialchars($app['no_kp']); ?></td>
                            <td><?= htmlspecialchars($app['jantina']); ?></td>
                            <td><?= htmlspecialchars($app['agama']); ?></td>
                            <td><?= htmlspecialchars($app['bangsa']); ?></td>
                            <td>RM <?= htmlspecialchars(number_format($app['fee_masuk'], 2)); ?></td>
                            <td>RM <?= htmlspecialchars(number_format($app['modah_syer'], 2)); ?></td>
                            <td>
                                <?php if ($app['status'] === 'Pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($app['status'] === 'Approved'): ?>
                                    <span class="badge bg-success">Approved</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No applications found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
