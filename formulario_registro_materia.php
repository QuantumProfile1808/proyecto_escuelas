<?php
?>
<?php include "encabezado.php" // Incluye el encabezado de la página ?>
<div class="row">
    <div class="col-12">
        <h1>Registro de materia</h1>
        <!-- Formulario para registrar una nueva materia -->
        <form action="guardar_materia.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <!-- Campo de texto para ingresar el nombre de la materia -->
                <input name="nombre" required type="text" id="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group">
                <!-- Botón para enviar el formulario y guardar los datos de la materia -->
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
<?php?>
