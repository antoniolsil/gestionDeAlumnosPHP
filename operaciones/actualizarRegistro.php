<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";

if (!empty($_SESSION["errores_actualizacion"])){
    print "
    <div class='container mt-5'>
    <div class='row justify-content-center'>
        <div class='col-md-6'>
        <div class='alert alert-danger text-center' role='alert'>
            <h4 class='alert-heading'>Error!</h4>
            <p>" . $_SESSION["errores_actualizacion"] ."</p>
        </div>
        </div>
    </div>
    </div>";
}


?>
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Select the student's name and DNI number</h1>
</div>


<div class="container">
    <form action="actualizarRegistro2.php" method="post">
        <div class="row">
            <div class="col-sm-5">
                <p class="d-block mb-1">Select by DNI</p>
                <input type="text" name="dni" class="form-control" placeholder="11111111A" maxlength="9" minlength="9">
            </div>
            <div class="col-sm-5">
                <p class="d-block mb-1">Select by Name</p>
                <input type="text" name="nombre" class="form-control">
            </div>
            <div class="col-sm-2">
                <br>
                <button type="submit" class="btn btn-primary w-100">Select</button>
            </div>
        </div>
    </form>
</div>
<?php
include "../html/pie.php";
?>