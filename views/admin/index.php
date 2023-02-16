<h1 class="nombre-pagina">Panel de administración</h1>

<?php  
    include_once __DIR__ . "/../templates/barra.php"; 
?>
<h2>Buscar citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                class="input"
                value="<?php echo $fecha;?>"
            />
        </div>
    </form>
</div>

<!-- Muestra mensaje en caso de que no haya citas, se utiliza count para verificar si hay algún arreglo -->

<?php

if(count($citas)===0){
    echo "<h2> No hay citas en esta fecha </>"; 
}

?>

<div id="citas-admin">
    
    <ul class="citas">
        <?php
            $idCita =0; 
            foreach($citas as $key=> $cita) {
                if($idCita !== $cita->id){
                    $total= 0; 
                
        ?> 
        <li>
            <h3>Datos del ciente:</h3>
            <p><span>ID: </span><?php echo $cita->id;?></p>
            <p><span>Cliente: </span> <?php echo $cita->cliente;?></p>
            <p><span>Hora: </span><?php echo $cita->hora;?></p>                       
            <p><span>Email: </span><?php echo $cita->email;?></p>
            <p><span>Teléfono: </span><?php echo $cita->telefono;?></p>

            <h3>Servicios:</h3>

                <?php 
                $idCita = $cita->id; 
                };
                $total += $cita->precio; 
                ?> <!-- Fin de if -->            
        </li> 
                <p class="servicio"><?php echo $cita->servicio . ": " . $cita->precio;?></p>
            <?php
                $actual = $cita->id;
                $proximo = $citas[$key +1]->id ?? 0;
                if(esUltimo($actual, $proximo)){ ?>
                    <p class="total"><span>Total: </span><?php echo "$" . $total;?></p>
                    
                    <form action="/api/eliminar" method="POST">
                        <input 
                            type="hidden" 
                            name="id"
                            value="<?php echo $cita->id;?>"
                        >

                        <input
                            type="submit"
                            class="boton-eliminar"
                            value="Eliminar"
                        >
                    </form>
            <?php };?>
        <?php  };?> <!-- Fin de foreach -->
    </ul> 
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"

?>


