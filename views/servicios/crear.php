<h1 class="nombre-pagina">Crear Nuevo Servicio</h1>
<p class="descripcion-pagina">LLena todos los campos para crear un servicio</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php    
    include_once __DIR__ . "/formulario.php";    
    ?>

    <input
        type="submit"
        class="boton-azul2"
        value="Guardar Servicio"
    >
</form>





