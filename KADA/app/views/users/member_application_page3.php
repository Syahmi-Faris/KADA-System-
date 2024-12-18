<form action="/member-application/submit" method="POST" enctype="multipart/form-data">
    <label>Fee Masuk:</label> 
    <input type="number" name="fee_masuk" required><br>
    <label>Modah Syer:</label> 
    <input type="number" name="modah_syer" required><br>
    <label>Upload Resit Pembayaran:</label> 
    <input type="file" name="receipt" required><br>
    <button type="submit">Submit</button>
</form>
