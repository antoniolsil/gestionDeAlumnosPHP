<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php"
?>

<br>
<h3 class='text-center text-primary'>Enter the DNI of the student to be deleted</h3>
<br>
<form class='text-center' action="eliminarRegistros2.php" method="post">
    <input type="text" name="dni" placeholder="11111111A" maxlength="9" minlength="9" required>
    <input type="submit" value="Delete">
</form>
<br>
<?php

// MOSTRAR LOS REGISTROS

include "../funciones/conexionBD.php";

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


include "../html/pie.php"
?>