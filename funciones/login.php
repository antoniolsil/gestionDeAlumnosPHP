<?php
session_start(); // Inicia la sesión
include "recoge.php";
include "conexionBD.php";

$_SESSION["usuario"] = recoge("username");
$contraseña = recoge("password");

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username=:username AND password=:password");
    
    $stmt->bindParam(':username', $_SESSION["usuario"]);
    $stmt->bindParam(':password', $contraseña);
    $stmt->execute();
  
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($result) {
        $_SESSION["sesion"] = "iniciada";
       header("Location: ../index.php");

    } else {
        $_SESSION["sesion"] = "incorrecta";
        header("Location: ../index.php");
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>