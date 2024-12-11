<?php
session_start();

include "../funciones/recoge.php";
include "../html/cabecera.php";

//RECOGIDA DE DATOS

$dni = recoge("dni");
$nombre = recoge("nombre");
$edad = recoge("edad");
$nota = recoge("nota");
$email = recoge("email");
$fecha_registro = recoge("fecha_registro");


//VERIFICACIÓN DE DATOS

$verificacion = true;


// Validar campos vacios
if (empty($dni) || empty($nombre) || empty($edad) || empty($email) || empty($fecha_registro) || empty($nota)) {
    $_SESSION["error"] = "You have left fields blank.";
    $verificacion = false;
    header("Location: añadirRegistros.php");
    exit;
}

// Validar formato del DNI
if (!preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
    $_SESSION["error"] = "Invalid DNI format. It must be 8 digits followed by a letter.";
    $verificacion = false;
    header("Location: añadirRegistros.php");
    exit;
}

// Validar el nombre
if (strlen($nombre) < 3) {
    $_SESSION["error"] = "The name must be at least 3 characters long.";
    $verificacion = false;
    header("Location: añadirRegistros.php");
    exit;
}

// Validar la edad
if (!is_numeric($edad) || $edad < 1 || $edad > 99) {
    $_SESSION["error"] = "The age must be a number between 1 and 99.";
    $verificacion = false;
    header("Location: añadirRegistros.php");
    exit;
}

// Validar el email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Invalid email format.";
    $verificacion = false;
    header("Location: añadirRegistros.php");
    exit;
}




//AÑADIR EL REGISTRO

include "../funciones/conexionBD.php";

try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar la sentencia sql de insertar datos
    $stmt = $conn->prepare("INSERT INTO students (dni, name, age, grade, email, registration_date)
    VALUES (:dni, :name, :age, :grade, :email, :registration_date)");

    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':name', $nombre);
    $stmt->bindParam(':age', $edad);
    $stmt->bindParam(':grade', $nota);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':age', $edad);
    $stmt->bindParam(':registration_date', $fecha_registro);
    $stmt->execute();

    print "
    <div class='container mt-5'>
    <div class='row justify-content-center'>
        <div class='col-md-4'>
        <div class='alert alert-success text-center' role='alert'>
            <h4 class='alert-heading'>Record added successfully</h4>
        </div>
        </div>
    </div>
    </div>";

    //Para mostrar el registro añadido


    print "<div class='container'>";
    print "<table class='table table-bordered table-striped text-center'>";
    print "<thead class='table-primary'>";
    print "<tr><th>DNI</th><th>Name</th><th>Age</th><th>Grade</th><th>Email</th><th>Entry Date</th></tr>";
    print "</thead>";
    print "<tbody>";

    $stmt = $conn->prepare("SELECT * FROM students WHERE dni ='$dni'");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
}


include "../html/pie.php";
?>