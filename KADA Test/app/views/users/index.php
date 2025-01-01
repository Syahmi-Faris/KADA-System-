<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-color: #f8f9fa;
            text-align: center;
            padding: 100px 0;
        }
        .hero-section h1 span {
            color: orange;
        }
        .card-section {
            background-color: #2d2f92;
            color: white;
            min-height: 60vh;
            padding: 120px 0;
        }
        .card-section .card {
            background-color: white;
            color: #2d2f92;
            border: none;
            text-align: center;
        }
        .navbar-brand img {
            height: 50px;
        }
        .btn-primary {
            background-color: orange;
            border: none;
        }
        .card-img-top {
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Lembaga Kemajuan <span>Pertanian Kemubu</span> (KADA)</h1>
            <a href="#" class="btn btn-primary mt-4">Learn More</a>
        </div>
    </section>

    <!-- Card Section -->
    <section class="card-section ">
    <div class="container">
  <div class="d-flex justify-content-between mt-4">
    <!-- First Card -->
    <div class="card text-center p-3" style="width: 20rem; border-radius: 12px;">
      <img src="placeholder.png" alt="Membership Applications" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title">Membership Applications</h5>
        <p class="card-text">
          Our membership offers tons of benefits ranging from finances to health.
        </p>
      </div>
    </div>
    
    <!-- Second Card -->
    <div class="card text-center p-3" style="width: 20rem; border-radius: 12px;">
      <img src="placeholder.png" alt="Loan Applications" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title">Loan Applications</h5>
        <p class="card-text">
          No money? Borrow from us with a guarantee of the lowest interest in Malaysia. Enjoy repayment periods of up to 20 years!
        </p>
      </div>
    </div>

    <!-- Third Card -->
    <div class="card text-center p-3" style="width: 20rem; border-radius: 12px;">
      <img src="placeholder.png" alt="Loan Calculator" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title">Loan Calculator</h5>
        <p class="card-text">
          Our calculator provides details about how much you need to pay when applying for loans with us.
        </p>
      </div>
    </div>
  </div>
</div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>