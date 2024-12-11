<?php
session_start(); //añade la sesión utilizada

session_destroy(); //finaliza la sesion

header("Location:../index.php"); //vuelve al index

?>