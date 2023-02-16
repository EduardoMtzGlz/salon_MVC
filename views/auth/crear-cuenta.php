<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Crea tu cuenta con los siguientes datos</p>

<?php  

include_once __DIR__ . "/../templates/alertas.php";

?>


<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            class="input"
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu Nombre"
            value="<?php echo san($usuario->nombre);?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            class="input"
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Tu Apellido"
            value="<?php echo san($usuario->apellido);?>"

        />
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input 
            class="input"
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Teléfono"
            value="<?php echo san($usuario->telefono);?>"

        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            class="input"
            type="email"
            id="email"
            name="email"
            placeholder="Tu Email"
            value="<?php echo san($usuario->email);?>"

        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            class="input"
            type="password"
            id="password"
            name="password"
            placeholder="Tu Password"
        />
    </div>
    <input type="submit" class="boton-azul" value="Crear Cuenta"/>
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/olvide">Olvide mi password</a>

</div>