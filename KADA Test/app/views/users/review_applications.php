<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Member Applications Section -->
        <h2 class="text-center mb-4">Member Applications</h2>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($memberApplications)): ?>
                    <?php foreach ($memberApplications as $application): ?>
                        <tr>
                            <td><?= htmlspecialchars($application['nama']); ?></td>
                            <td><?= htmlspecialchars($application['alamat_rumah']); ?></td>
                            <td><?= htmlspecialchars($application['no_tel_bimbit']); ?></td>
                            <td>
                                <?php if ($application['status'] === 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($application['status'] === 'accepted'): ?>
                                    <span class="badge bg-success">Accepted</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="/update-application-status/<?= $application['id'] ?>/accepted/member" method="POST" style="display: inline;">
                                    <button type="submit" class="btn btn-success px-4">Accept</button>
                                </form>
                                <form action="/update-application-status/<?= $application['id'] ?>/rejected/member" method="POST" style="display: inline;">
                                    <button type="submit" class="btn btn-danger px-4">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No member applications available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Loan Applications Section -->
        <h2 class="text-center mb-4">Loan Applications</h2>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>IC Number</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Duration (Years)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($loanApplications)): ?>
                    <?php foreach ($loanApplications as $loan): ?>
                        <tr>
                            <td><?= htmlspecialchars($loan['name']); ?></td>
                            <td><?= htmlspecialchars($loan['ic_number']); ?></td>
                            <td><?= htmlspecialchars($loan['loan_type']); ?></td>
                            <td>RM <?= number_format($loan['loan_amount'], 2); ?></td>
                            <td><?= htmlspecialchars($loan['loan_duration']); ?></td>
                            <td>
                                <?php if ($loan['status'] === 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($loan['status'] === 'accepted'): ?>
                                    <span class="badge bg-success">Accepted</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="/update-application-status/<?= $loan['id'] ?>/accepted/loan" method="POST" style="display: inline;">
                                    <button type="submit" class="btn btn-success px-4">Accept</button>
                                </form>
                                <form action="/update-application-status/<?= $loan['id'] ?>/rejected/loan" method="POST" style="display: inline;">
                                    <button type="submit" class="btn btn-danger px-4">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No loan applications available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
