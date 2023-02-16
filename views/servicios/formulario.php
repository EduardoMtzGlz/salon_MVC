<div class="campo">
    <label for="nombre">Nombre</label>
    <input 
        type="text" 
        name="nombre"
        placeholder="Nombre del Servicio"
        class="input" 
        value="<?php echo $servicio->nombre;  ?>"
    >

</div>

<div class="campo">
<label for="precio">Precio</label>
    <input 
        type="number" 
        name="precio"
        placeholder="Precio del Servicio"
        class="input" 
        value="<?php echo $servicio->precio;  ?>"

    >
</div>
