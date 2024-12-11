<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";

//muestra los errores
if (isset($_SESSION['error'])):
    print '<div class="alert alert-danger text-center">';
    print $_SESSION['error'];
    print '</div>';
    unset($_SESSION['error']);
endif;

//muestra si la opracion ha tenido exito
if (isset($_SESSION['success'])):
    print '<div class="alert alert-success text-center">';
    print $_SESSION['success'];
    print '</div>';
    unset($_SESSION['success']);
endif;

?>
<div class="container mt-5">
  <h1 class="text-center text-primary mb-4">Change Your Password</h1>
  <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
    <form action="cambiarContraseña2.php" method="post">
      <div class="mb-3">
        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" maxlength="255" required>
      </div>
      <div class="mb-3">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your new password" maxlength="255" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Change Password</button>
    </form>
  </div>
</div>

<?php
include "../html/pie.php";
?>