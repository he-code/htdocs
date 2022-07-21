<div class="formus">
    
    <form style="width:40%; margin-bottom: 2rem ;" action="" method="post">
        <label for="">Selecione una Institución Educativa</label>
        <select name="institucion" id="institucion">
            <option value="#" id="lider-institucional">...</option>
                    <?php foreach($instituciones as $institucion):?>
                        <option value="<?= $institucion->id?>"> <?= $institucion->nombre?> </option>
                    <?php endforeach; ?>
        </select><button id="agg-new-institucion">Agregar nueva Insticion</button>
        <div class="opciones-instituciones"></div>
        <label for="">Selecione una lider de esta institucion</label>
        <select name="lider" id="lider-institucion">
        </select><button id="lider-persona">Ingrese un nuevo lider</button>
        <div class="opciones-lider"></div>
        <label for="">Selecione una categoria de los materiales</label>
        <select name="categoria" id="categoria-acta">
            <option value="#"> # </option>
            <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria->id ?>"><?= $categoria->nombre?></option>
                <?php endforeach; ?>
        </select>
        <div class="opciones-material">
                
        </div>
                
        <button type="submit" id="next">Guardar</button>
    </form>
</div>
    
