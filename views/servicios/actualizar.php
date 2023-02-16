<h1 class="nombre-pagina">Actualización de Servicios</h1>
<p class="descripcion-pagina">LLena todos los campos para actualizar el servicio</p>

<?php
    
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form method="POST" class="formulario">
    <?php    
    include_once __DIR__ . "/formulario.php";    
    ?>

    <input
        type="submit"
        class="boton-azul2"
        value="Actualizar Servicio"
    >
</form>
