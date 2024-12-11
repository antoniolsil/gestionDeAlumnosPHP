<?php
session_start(); // Inicia la sesión

include "html/cabecera_index.php";

// Verificar si la variable de sesión "sesion" está vacía
if (empty($_SESSION["sesion"])) {
    include "html/formulariologin.php";
} elseif ($_SESSION["sesion"] == "incorrecta") {
    print "<br><br><div class='container'>
                <div class='row justify-content-center'>
                    <div class='col-4'>
                        <div class='alert alert-danger text-center' role='alert'>
                            <h4 class='alert-heading'>Error!</h4>
                            <p>No user found or incorrect credentials!</p>
                        </div>
                    </div>
                </div>
            </div>";

    include "html/formulariologin.php";

} elseif ($_SESSION["sesion"] == "iniciada") {
    print "<br><div class=\"container\">
        <div class=\"row justify-content-center\">
          <div class=\"col-5 text-center\">
            <div class=\"alert alert-primary\" role=\"alert\">
                <h4 class=\"alert-heading\">Choose an option!</h4>
             </div>
            </div>
        </div>
    </div>
\n";

    include "html/botones.php";
}

include "html/pie.php";
