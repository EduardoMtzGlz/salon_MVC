<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php  

    include_once __DIR__ . "/../templates/alertas.php"

?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input
            class="input"
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input
            class="input"
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password"
        />
    </div>
    <input type="submit" class="boton-azul" value="Iniciar Sesión"/>
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿No tienes cuenta? Créala dando clic aquí</a>
    <a href="/olvide">Olvide mi password</a>

</div>

