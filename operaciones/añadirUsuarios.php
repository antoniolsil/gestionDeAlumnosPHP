<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";

if (isset($_SESSION['error'])) { //LA FUNCIÓN isset COMPRUEBA SI UNA VARIABLE ESTÁ DEFINIDA. Si lo está devuelve true
    print "<div class='container mt-5'>";
    print "  <div class='row justify-content-center'>";
    print "    <div class='col-sm-6'>";
    print "      <div class='alert alert-danger text-center shadow-sm' role='alert'>";
    print "        <strong>Error:</strong> " . $_SESSION['error'] . "</div>";
    print "    </div>";
    print "  </div>";
    print "</div>";
    
}elseif(isset($_SESSION['success'])){
    print "
    <div class='container mt-5'>
    <div class='row justify-content-center'>
        <div class='col-sm-4'>
        <div class='alert alert-success text-center'>
            User successfully added!
        </div>
        </div>
    </div>
    </div>";
    
}
unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo para que no se quede alamacenado en la varible constantemente
unset($_SESSION['success']);
?>
<div class="container mt-5">
  <h1 class="text-center text-primary mb-4">Add a New User</h1>
  <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
    <form action="añadirUsuarios2.php" method="post">
      <div class="mb-3">
        <p class="d-block">Username</p>
        <input type="text" name="usuarioAñadir" class="form-control" placeholder="Enter username" maxlength="75">
      </div>
      <div class="mb-3">
        <p class="d-block">Password</p>
        <input type="password" name="contraseñaUsuario" class="form-control" placeholder="Enter password" maxlength="100">
      </div>
      <button type="submit" class="btn btn-primary w-100">Add User</button>
    </form>
  </div>
</div>


<?php
include "../html/pie.php";
?>