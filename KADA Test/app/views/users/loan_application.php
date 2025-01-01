<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <style>
        /* Custom CSS for input margins */
        input, textarea, select {
            margin-bottom: 1.5rem; /* Adjust the value as needed */
        }
    </style> 
</head>
<body>

    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">KADA Loan Application</h1>
            <p class="text-muted">Complete the form below to apply for a loan</p>
        </div>

        <!-- Loan Application Form -->
        <form action="/loan" method="POST" enctype="multipart/form-data" id="loanForm" class="mb-4">
        
        <div class="p-4 border rounded shadow bg-white mb-4">
        <!-- Personal Details -->
        <h3 class="mb-3">Personal Details</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6">
                    <label for="ic_number" class="form-label">IC Number</label>
                    <input type="text" name="ic_number" class="form-control" id="ic_number" placeholder="e.g. 040801=01" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone" placeholder="e.g. 017-567-9202" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control" id="postcode" placeholder="e.g. 77100" required>
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Home Address</label>
                    <textarea name="address" class="form-control" id="address" rows="2" placeholder="Enter your address" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="staff_no" class="form-label">Staff Number</label>
                    <input type="text" name="staff_no" class="form-control" id="staff_no" placeholder="e.g. 12345" required>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="race" class="form-label">Race</label>
                    <select name="race" id="race" class="form-select" required>
                        <option value="Malay">Malay</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Indian">Indian</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="religion" class="form-label">Religion</label>
                    <input type="text" name="religion" class="form-control" id="religion" placeholder="e.g. Islam" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="office_address" class="form-label">Office Address</label>
                    <textarea name="office_address" class="form-control" id="office_address" rows="2" placeholder="Enter your office address" required></textarea>
                </div>
            </div>


        </div>
            
        <div class="p-4 border rounded shadow bg-white mb-4">
         <!-- Loan Details -->
         <h3 class="mb-3">Loan Details</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="loan_type" class="form-label">Types of Loan</label>
                    <select name="loan_type" id="loan_type" class="form-select" required>
                        <option value="Al Bai">Al Bai </option>
                        <option value="Al-Innah">Al-Innah </option>
                        <option value="Al-Qadrul Hassan">Al-Qadrul Hassan</option>
                        <option value="Vehicle Restoration">Vehicle Restoration</option>
                        <option value="Road Tax & Insurance">Road Tax & Insurance</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="loan_amount" class="form-label">Loan Amount (RM)</label>
                    <input type="number" name="loan_amount" class="form-control" id="loan_amount" placeholder="e.g. 54000" required>
                </div>
                <div class="col-md-3">
                    <label for="loan_duration" class="form-label">Loan Duration (Years)</label>
                    <input type="number" name="loan_duration" class="form-control" id="loan_duration" placeholder="e.g. 9" required>
                </div>
            </div>
            <div class="row mb-3">
            <div class="col-md-6">
                <label for="bank_account_no" class="form-label">Bank Account Number</label>
                <input type="text" name="bank_account_no" class="form-control" id="bank_account_no" placeholder="e.g. 1234567890" required>
            </div>
            <div class="col-md-6">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="e.g. Maybank" required>
            </div>
        </div>
        <h5 class="mb-3">Please upload the following documents:</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="payslip_file" class="form-label">Payslip</label>
                    <input type="file" name="payslip_file" class="form-control" id="payslip_file" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="col-md-6">
                    <label for="bank_statement_file" class="form-label">Bank Statement</label>
                    <input type="file" name="bank_statement_file" class="form-control" id="bank_statement_file" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
            </div>
        </div>
         <!-- File Upload Section -->
         

        <div class="p-4 border rounded shadow bg-white mb-4">
         <!-- Guarantors Information -->
         <h3 class="mb-3">Guarantors Information</h3>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="guarantor1_name" class="form-label">Guarantor 1 Name</label>
                    <input type="text" name="guarantor1_name" class="form-control" id="guarantor1_name" placeholder="Full name" required>
                </div>
                <div class="col-md-4">
                    <label for="guarantor1_ic" class="form-label">Guarantor 1 IC Number</label>
                    <input type="text" name="guarantor1_ic" class="form-control" id="guarantor1_ic" placeholder="e.g. 040801=01" required>
                </div>
                <div class="col-md-4">
                    <label for="guarantor1_staff_no" class="form-label">Guarantor 1 Staff Number</label>
                    <input type="text" name="guarantor1_staff_no" class="form-control" id="guarantor1_staff_no" placeholder="e.g. 12345" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="guarantor2_name" class="form-label">Guarantor 2 Name</label>
                    <input type="text" name="guarantor2_name" class="form-control" id="guarantor2_name" placeholder="Full name" required>
                </div>
                <div class="col-md-4">
                    <label for="guarantor2_ic" class="form-label">Guarantor 2 IC Number</label>
                    <input type="text" name="guarantor2_ic" class="form-control" id="guarantor2_ic" placeholder="e.g. 040801=01" required>
                </div>
                <div class="col-md-4">
                    <label for="guarantor2_staff_no" class="form-label">Guarantor 2 Staff Number</label>
                    <input type="text" name="guarantor2_staff_no" class="form-control" id="guarantor2_staff_no" placeholder="e.g. 12345" required>
                </div>
            </div>
        </div>
           

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-50">Submit Application</button>
            </div>
        </form>
    </div>

      <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Submission Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Your loan application has been received and is being processed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

 

    <!-- Bootstrap JS and AJAX Handler -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loanForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Stop the form from redirecting

            // Gather form data
            const formData = new FormData(this);

            // Send data to the server using AJAX
            fetch('/loan', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Show the success modal
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    // Optionally reset the form
                    document.getElementById('loanForm').reset();
                } else {
                    alert("Something went wrong. Please try again.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred. Please try again later.");
            });
        });
    </script> -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>