<?php
session_start();

//si el usuario no está logeado lo devuelve al index
if ($_SESSION["sesion"] !== "iniciada") {
    header("Location:../index.php");
}

include "../html/cabecera.php";


include "../funciones/conexionBD.php";

//Numero de estudiantes
$numeroEstudiantes = "SELECT COUNT(*) AS total_students FROM students";
$resultadoCuenta = $conn->query($numeroEstudiantes);
$cuentaEstudiantes = $resultadoCuenta->fetch(PDO::FETCH_ASSOC)['total_students'];

// meida  de edad
$consultaMediaEdad = "SELECT AVG(age) AS avg_age FROM students";
$resultadoMedia = $conn->query($consultaMediaEdad);
$mediaEdad = $resultadoMedia->fetch(PDO::FETCH_ASSOC)['avg_age'];

// cantidad de cada nota
$numeroNotas = "SELECT grade, COUNT(*) AS count FROM students GROUP BY grade";
$resultadoNotas = $conn->query($numeroNotas);

// numero de usuarios registrados 
$usuariosRegistrados = "SELECT COUNT(*) AS total_users FROM users";
$resultadoUsuarios = $conn->query($usuariosRegistrados);
$totalUsuarios = $resultadoUsuarios->fetch(PDO::FETCH_ASSOC)['total_users'];
?>

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Database Statistics</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text"><?php print $cuentaEstudiantes; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
               <div class="card-body text-center">
                    <h5 class="card-title">Average Age</h5>
                    <p class="card-text"><?php print $mediaEdad; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php print $totalUsuarios; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Grade Distribution</h5>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultadoNotas->fetchAll(PDO::FETCH_ASSOC) as $nota){
                               print "<tr>";
                                    print"<td>" . $nota['grade'] . "</td>";
                                    print "<td>" . $nota['count']  . "</td>";
                                print"</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

</body>

</html>

<?php
include "../html/pie.php";
?>