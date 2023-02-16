<div class="barra">
    <p>Hola: <?php  echo $nombre ?? ""; ?></p>
    <a href="/logout" class="boton-cerrar">Cerrar sesión</a>
</div>

<?php 

if(isset($_SESSION["admin"])) { ?>
    <div class="barra-servicios">
       <a class="boton-azul2" href="/admin">Ver Citas</a>
       <a class="boton-azul2" href="/servicios">Ver Servicios</a>
       <a class="boton-azul2" href="/servicios/crear">Nuevo Servicio</a>
       

    </div>


<?php } ?>


