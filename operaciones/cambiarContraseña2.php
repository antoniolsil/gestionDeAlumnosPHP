<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../funciones/recoge.php";

$new_password = recoge("new_password");
$confirm_password = recoge("confirm_password");
    // Comprobar que los campos no estén vacios
    if (empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = 'Both password fields are required.';
        header('Location: cambiarContraseña.php'); // Redirige a la página del formulario
        exit();
    }

    // Verificar que ambass contraseñas coincidan
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = 'The passwords do not match. Please try again.';
        header('Location: cambiarContraseña.php');
        exit();
    }

    include "../funciones/conexionBD.php";
    try {
       
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $username = $_SESSION['usuario'];

        // Actualización en la base de datos
        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->bindParam(':password', $new_password);
        $stmt->bindParam(':username', $username);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Your password has been updated successfully.';
            header('Location: cambiarContraseña.php'); 
        } else {
            $_SESSION['error'] = 'Error updating password. Please try again.';
            header('Location: cambiarContraseña.php'); 
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header('Location: cambiarContraseña.php');
    }
?>