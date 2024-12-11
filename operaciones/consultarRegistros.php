<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../funciones/conexionBD.php"; // llama a la función que conecta con la base de datos

include "../html/cabecera.php";

print "<br><h1 class='text-center text-primary'>Students Registered in the System</h1>";
print "<br><br>";

print "<div class='container'>";
print "<table class='table table-bordered table-striped text-center'>";
print "<thead class='table-primary'>";
print "<tr><th>DNI</th><th>Name</th><th>Age</th><th>Grade</th><th>Email</th><th>Entry Date</th></tr>";
print "</thead>";
print "<tbody>";

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM students");
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
} catch (PDOException $e) {
    print "<tr><td colspan='6' class='text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}

print "</tbody>";
print "</table>";
print "</div>";

include "../html/pie.php";