<?php
session_start();

include "../funciones/recoge.php";
include "../html/cabecera.php";

$nombre = recoge("nombre");

//Validación de datos

$_SESSION["error_busqueda"] = false;

if (empty($nombre) || is_numeric($nombre)){
    $_SESSION["error_busqueda"] = true;
    header("Location: buscarRegistros.php");
}

include "../funciones/conexionBD.php";

try {
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparación de SQL
    $stmt = $conn->prepare("SELECT * FROM students WHERE name = :name");
    $stmt->bindParam(':name', $nombre);
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
    header("Location: buscarRegistros.php");
    $_SESSION["error_busqueda"] = true;
}
?>