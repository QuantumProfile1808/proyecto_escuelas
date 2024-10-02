<?php
 ?>
<?php include "encabezado.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo-registro.css">
    <title>Registro de Estudiante</title>
</head>
<body>
    <div class="row">
        <div class="caja">
            <h1>Registro de estudiante</h1>
            <form action="guardar_estudiante.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" required type="text" id="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input name="grupo" required type="text" id="grupo" class="form-control" placeholder="Grupo">
                </div>
                <div class="form-group">
                    <button class="btn boton-guardar" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php ?>