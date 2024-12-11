<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}


// Recoger datos del formulario
include "../funciones/recoge.php";

$addUsername = recoge("usuarioAñadir");
$contraseña = recoge("contraseñaUsuario");


// Comprobaciones
$errores = [];

if ($addUsername === '') {
    $errores[] = 'The username field cannot be empty.';
} elseif (strlen($addUsername) > 255) {
    $errores[] = 'The username cannot exceed 255 characters.';
}

if ($contraseña === '') {
    $errores[] = 'The password field cannot be empty.';
} elseif (strlen($contraseña) > 255) {
    $errores[] = 'The password cannot exceed 255 characters.';
}

// Verificar si hay errores
if (!empty($errores)) {
    $_SESSION['error'] = implode(' ', $errores); // Guardar errores en el array
    header('Location: añadirUsuarios.php');
    exit;
}

include '../funciones/conexionBD.php';

// PAra verificar si el usuario ya existe
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $addUsername, PDO::PARAM_STR);
    $stmt->execute();

    // Verifica si se obtuvo un resultado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // si hay algun resultado en la select significa que el usuario ya existe
    if ($user) {
        $_SESSION['error'] = 'The username already exists. Please choose another one.';
        header('Location: añadirUsuarios.php');
        exit();
    }



} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('Location: añadirUsuarios.php');
    exit();
}

// Insertar el usuario en la base de datos
try {

    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $stmt->bindParam(':username', $addUsername);
    $stmt->bindParam(':password', $contraseña);
    $stmt->execute();

    $_SESSION['success'] = 'User successfully added!';
    header('Location: añadirUsuarios.php');

} catch (PDOException $e) {
    $_SESSION['error'] = 'Error: ' . $e->getMessage();
    header('Location: añadirUsuarios.php');
}
$conn = null;


?>