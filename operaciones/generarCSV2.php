<?php
session_start();
//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";

include "../funciones/conexionBD.php";

try {
    // realización de la consulta
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM students");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Abrir el archivo CSV en modo escritura
    $file = fopen('../students_data.csv', 'w');

    // Escribir los encabezados del CSV (nombres de las columnas)
    $headers = ['DNI', 'Name', 'Age', 'Grade', 'Email', 'Registration Date'];
    fputcsv($file, $headers);

    // Escribir los registros de la base de datos en el archivo CSV
    foreach ($results as $registro) {
        // Escribir cada registro como una fila en el archivo CSV
        fputcsv($file, [
            $registro['dni'],
            $registro['name'],
            $registro['age'],
            $registro['grade'],
            $registro['email'],
            $registro['registration_date']
        ]);
    }
    
    fclose($file);
    print "<br><br>";
    print "<div class='container d-flex justify-content-center align-items-center'>";
    print "<div class='col-sm-4 alert alert-success text-center'>";
    print "Data has been successfully exported to <strong>students_data.csv</strong>.";
    print "</div>";
    print "</div>";

    
} catch (PDOException $e) {
    print "<div class='alert alert-danger text-center'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<div class="container mt-5">
  <h1 class="text-center text-primary mb-4">Download Student Data</h1>
  <div class="card p-4 shadow-lg" style="max-width: 600px; margin: 0 auto;">
    <div class="text-center">
      <p>If you want to download the student data as a CSV file, click the button below:</p>
      <a href="../students_data.csv" class="btn btn-outline-success">
        Download CSV File
      </a>
    </div>
  </div>
</div>


<?php

include "../html/pie.php"

?>