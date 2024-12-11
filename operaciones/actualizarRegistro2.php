<?php
session_start();
//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../funciones/recoge.php";

$_SESSION["dni_actualizacion"] = recoge("dni");
$_SESSION["nombre_actualizacion"] = recoge("nombre");

include "../html/cabecera.php";

if (!empty($_SESSION["verificacion"]) && $_SESSION["verificacion"] == false){
    print "
    <div class='container mt-3'>
        <div class='alert alert-danger' role='alert'>
            <strong>Error:</strong> You have entered an incorrect field.
        </div>
    </div>
    ";
}




print "<div class='container mt-5'>";
print "<h1 class='text-center text-primary mb-4'>Student Selected: " . $_SESSION["nombre_actualizacion"] . " " .$_SESSION["dni_actualizacion"] ."</h1>";
print "</div>";

//mostrar registro seleccionado

include "../funciones/conexionBD.php";

try {
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparación de SQL
    $stmt = $conn->prepare("SELECT * FROM students WHERE name = :name OR dni = :dni");
    $stmt->bindParam(':name', $_SESSION["nombre_actualizacion"]);
    $stmt->bindParam(':dni', $_SESSION["dni_actualizacion"]);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    print "<br><br><div class='container'>";
    print "<table class='table table-bordered table-striped text-center'>";
    print "<thead class='table-primary'>";
    print "<tr><th>DNI</th><th>Name</th><th>Age</th><th>Grade</th><th>Email</th><th>Entry Date</th></tr>";
    print "</thead>";
    print "<tbody>";
    foreach ($results as $registro) {
        print "<tr>
            <td>" . htmlspecialchars($registro['dni']) . "</td>
            <td>" . htmlspecialchars($registro['name']) . "</td>
            <td>" . htmlspecialchars($registro['age']) . "</td>
            <td>" . htmlspecialchars($registro['grade']) . "</td>
            <td>" . htmlspecialchars($registro['email']) . "</td>
            <td>" . htmlspecialchars($registro['registration_date']) . "</td>
        </tr>";
    }
    print "</tbody>";
    print "</table>";
    print "</div>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    header("Location: buscarRegistros.php");
}
$conn = null;
?>

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Students Data</h1>
    <div class="row">
        <!-- Mensajes de advertencia -->
        <div class="col-md-4">
            <div class="alert alert-danger mb-3" role="alert">
                <strong>IMPORTANT:</strong> When modifying student data, you must re-enter all the required information in the form, even if it hasn't changed. Otherwise, it will be lost in the database.
            </div>
        
            <div class="alert alert-warning" role="alert">
                <strong>Note:</strong> The name or DNI of a student cannot be changed. If you made a mistake, delete the student and add them again.
            </div>
        </div>
        <!-- formulario -->
        <div class="col-md-8">
            <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
                <form action="actualizarRegistro3.php" method="post">
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
    </div>
</div>


<?php
    include "../html/pie.php"
?>

