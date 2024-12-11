<?php
session_start();

include "../funciones/recoge.php";


$edad = recoge("edad");
$nota = recoge("nota");
$email = recoge("email");
$fecha_registro = recoge("fecha_registro");

include "../html/cabecera.php";
//VERIFICACION DE DATOS

// Validar campos vacios
if (empty($edad) || empty($email) || empty($fecha_registro) || empty($nota)) {
    $_SESSION["error"] = "You have left fields blank.";
    $_SESSION["verificacion"]  = false;
    header("Location: actualizarRegistro2.php");
    exit;
}
// Validar la edad
if (!is_numeric($edad) || $edad < 1 || $edad > 99) {
    $_SESSION["error"] = "The age must be a number between 1 and 99.";
    $_SESSION["verificacion"]  = false;
    header("Location: actualizarRegistro2.php");
    exit;
}

// Validar el email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Invalid email format.";
    $_SESSION["verificacion"]  = false;
    header("Location: actualizarRegistro2.php");
    exit;
}

include "../funciones/conexionBD.php";

try {

    //Para actualizar los datos
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("UPDATE students 
    SET age = :age, grade = :grade, email = :email, registration_date = :fecha_registro 
    WHERE dni = :dni OR name = :name");

    $stmt->bindParam(':dni', $_SESSION["dni_actualizacion"]);
    $stmt->bindParam(':name', $_SESSION["nombre_actualización"]);
    $stmt->bindParam(':age', $edad);
    $stmt->bindParam(':grade', $nota);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':fecha_registro', $fecha_registro);

    $stmt->execute();


    //Para mostrar los datos actualizados
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
    print "
    <div class='container d-flex justify-content-center align-items-center'>
      <div class='alert alert-success text-center' role='alert' style='max-width: 500px; width: 100%;'>
        <h4 class='alert-heading'>RECORD UPDATED SUCCESSFULLY</h4>
      </div>
    </div>";



} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
include "../html/pie.php"

?>