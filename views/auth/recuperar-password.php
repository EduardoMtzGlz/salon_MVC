<h1 class="nombre-pagina">Reestablece tu Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo Password a continuación</p>

<?php  
include_once __DIR__ . "/../templates/alertas.php";
?>

<?php  if($error) return?>

<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password">Password</label>
        <input
            class="input"
            type="password"
            id="password"
            placeholder="Tu Nuevo Password"
            name="password"
        />
    </div>
    <input type="submit" class="boton-azul" value="Reestablecer Password"/>
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">Crear nueva cuenta</a>

</div>