<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php
    include_once __DIR__ . "/../templates/barra.php"
?>

<ul class="servicios"> 
    <?php 
        foreach($servicios as $servicio){ ?>
            <li>
                <p><span>Nombre:</span> <?php  echo $servicio->nombre?></p>
                <p><span>Precio: </span> <?php  echo "$" .$servicio->precio?></p>
            </li>
            <div class="acciones-servicios">
                <a class="boton-verde" href="/servicios/actualizar?id=<?php echo $servicio->id?>">Actualizar Servicio</a>
                <form action="/servicios/eliminar" method="POST">
                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $servicio->id; ?>"
                    >
                    <input
                        type="submit"
                        value="Borrar"
                        class="boton-eliminar"
                    >

                </form>
            </div>
        <?php }
    
    ?>

</ul>