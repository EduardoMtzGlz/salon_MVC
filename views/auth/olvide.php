<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email</p>

<?php  

    include_once __DIR__ . "/../templates/alertas.php"

?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email</label>
        <input
            class="input"
            type="email"
            name="email"
            id="email"
            placeholder="Tú Email"
        />
    </div>
    <input type="submit" class="boton-azul" value="Enviar Instrucciones">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear Una</a>

</div>