<div class="formus">
    
    <form style="width:40%; margin-bottom: 2rem ;" action="" method="post">
        <!-- <label for="">Digite el nombre de quien autoriza</label>
        <input type="text" name="autoriza" required placeholder="Nombre de Persona"> -->
        <label for="">Ingrese el tipo</label>
        <input type="text" placeholder="Como compra por ejemplo" name="tipo" required>
        <label for="">Ingrese el C.I/RUC</label>
        <input type="text" placeholder="RUC o CI" name="ruc" required>
        <label for="">Selecione un proovedor</label>
        <select name="proovedor">
            <?php foreach($proovedores as $proveedor):?>
                <option value="<?=$proveedor->id?>"><?= $proveedor->nombre. ' ' . $proveedor->apellido ?> </option>
            <?php endforeach; ?>
        </select><button id="agregar-proovedor"> Agregar Nuevo Proovedor  </button>
        <div class="opciones-proovedor"></div>
        <label for="">Ingrese el codigo de la factura</label>
        <input type="text" placeholder="Numero" name="factura" required>
        <label for="">Ingrese el proceso</label>
        <input type="text"  name="proceso" placeholder="Por ejemplo Catalogo Electronico" required>
        <label for="">Ingrese el numero de solicitud</label>
        <input type="text" placeholder="Numero" name="solicitud" required>
        <label for="">Ingrese a al categoria que pertenecen los materiales</label>
        <select name="categoria">
            <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
              <?php endforeach; ?>  
        </select><button id="agg-categoria" >Agregar una nueva Categoria</button>
        <div class="opciones-categoria">
                
        </div>
        <label for="">Ingrese el numero de materiales que pertenecen a esta solicitud</label>
        <input type="number"  id="cantidad-materiales" min="1" name="referecia">
        <div class="contenedor-materiales">
                
        </div>
        <button type="submit">Ingresar</button>
    </form>
</div>
