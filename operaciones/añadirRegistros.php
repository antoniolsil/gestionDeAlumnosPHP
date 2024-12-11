<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}


include "../funciones/recoge.php";

include "../html/cabecera.php";

if (!empty($_SESSION["error"])) { //muestra el mensaje de error si ha salido alguno en añadirRegistros2.php
    print "
<div class='container mt-5'>
  <div class='alert alert-danger text-center' role='alert'>
    <h4 class='alert-heading'>Error!</h4>
    <p>" . $_SESSION["error"] . "</p>
  </div>
</div>";
}
?>
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Add a New Student</h1>
    <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
        <form action="añadirRegistros2.php" method="post">
            <div class="mb-3">
                <p class="d-block mb-1">DNI</p>
                <input type="text" name="dni" class="form-control" placeholder="11111111A" maxlength="9" minlength="9" required>
            </div>
            <div class="mb-3">
                <p class="d-block mb-1">Name</p>
                <input type="text" name="nombre" class="form-control" placeholder="Juan Cuesta" maxlength="100" required>
            </div>
            <div class="mb-3">
                <p class="d-block mb-1">Age</p>
                <input type="number" name="edad" class="form-control" placeholder="15" max="99" required>
            </div>
            <div class="mb-3">
                <p class="d-block mb-1">Grade</p>
                <input type="text" name="nota" class="form-control" placeholder="A+" max="5">
            </div>
            <div class="mb-3">
                <p class="d-block mb-1">Email</p>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <p class="d-block mb-1">Registration Date</p>
                <input type="date" name="fecha_registro" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
<?php
include "../html/pie.php"
?>