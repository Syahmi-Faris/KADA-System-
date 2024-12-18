<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<nav class="navbar fixed-top navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand h1 mb-0" href="#">
        UTM
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
        <a class="nav-link" href="/logout">Logout</a>
      </div>
    </div>
  </div>
</nav>
<br><br><br>
    <h2 class="class display-6 text-center my-3">Application lists</h2>

    <div class="m-4 p-3 rounded border border-2 shadow-sm">
    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr class = "text-center">
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>status</th>
                <th>Answer</th>
            </tr>
        </thead>
    
        <tbody class="table-group-divider">
            <?php foreach ($applications as $application): ?>
                <tr class = "text-center">
                    <td class="text-center"><?= $application['nama'] ?></td>
                    <td class="text-center"><?= $application['alamat_rumah'] ?></td>
                    <td><?= $application['no_tel_bimbit'] ?></td>
                    <td><?= $application['status'] ?></td>
                    <td>
                        <!-- Accept Button -->
                        <form action="/update-application-status/<?= $application['id'] ?>/accepted" method="POST" style="display: inline;">
                            <button type="submit" class="btn btn-success px-4">Accept</button>
                        </form>

                        <!-- Reject Button -->
                        <form action="/update-application-status/<?= $application['id'] ?>/rejected" method="POST" style="display: inline;">
                            <button type="submit" class="btn btn-danger px-4">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>  
        </tbody>  
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>