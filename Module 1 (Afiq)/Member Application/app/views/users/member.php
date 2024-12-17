<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for membership</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

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
<h2 class="class display-6 text-center my-3">Membership Application</h2>

<div class="container-fluid">
        <div class="row justify-contents-center">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="m-3 p-3 rounded border border-2 bg-white shadow-sm">
                <form method="POST" action="/member">
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name" required><br><br>
    
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" required><br><br>
    
                    <label for="phone">Phone</label><br>
                    <input type="text" id="phone" name="phone"><br><br>

                    <label for="address">Address</label><br>
                    <textarea id="address" name="address" required></textarea><br><br>

                    <label for="payment">Payment of RM50</label><br>
                    <input type="checkbox" id="payment" name="payment" required>
                    <label for="payment">I have paid the RM50 membership fee</label><br><br>

                    <button type="submit" class="btn btn-success">Submit Application</button>
                </form>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
