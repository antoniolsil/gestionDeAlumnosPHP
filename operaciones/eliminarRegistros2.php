<?php
include "../funciones/recoge.php";
include "../funciones/conexionBD.php";

$dni = recoge("dni");

try {
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparación de SQL
    $stmt = $conn->prepare("DELETE FROM students WHERE dni = :dni");
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    header("Location: eliminarRegistros.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>