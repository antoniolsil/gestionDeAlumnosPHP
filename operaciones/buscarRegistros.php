<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";

if (!empty($_SESSION["error_busqueda"])){
    print "
    <div class='container mt-5'>
    <div class='row justify-content-center'>
        <div class='col-md-6'>
        <div class='alert alert-danger text-center' role='alert'>
            <h4 class='alert-heading'>Error!</h4>
            <p>You have not entered a valid name or it is not registered in the system.</p>
        </div>
        </div>
    </div>
    </div>";
}

?>
<br>
<h3 class='text-center text-primary'>Enter the student's name</h3>
<br>
<form class='text-center' action="buscarRegistros2.php" method="post">
    <input type="text" name="nombre"  maxlength="100" required>
    <input type="submit" value="Search">
</form>
<br>
<?php

include "../html/pie.php";
?>