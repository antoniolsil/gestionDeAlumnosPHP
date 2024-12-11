<?php
session_start();
//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";
?>
<div class="container mt-5">
  <h1 class="text-center text-primary mb-4">Export Students Data to CSV</h1>
  <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
    <form action="generarCSV2.php" method="post">
      <div class="mb-4">
        <p class="text-center">If you continue, all student data will be exported to a CSV file. Do you wish to proceed?</p>
      </div>
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-outline-primary">Yes, Export</button>
        <a href="../index.php" class="btn btn-outline-danger">Cancel</a>
      </div>
    </form>
  </div>
</div>

<?php
include "../html/pie.php";
?>