
<div class="formus">
    <?php if (isset($exito)): ?>
        
    <div class="exito">
        <?= $exito ?> 
    </div>

    <?php endif ?>
    <?php if (isset($error)): ?>
        
        <div class="error">
            <?= $error ?> 
        </div>
    
        <?php endif ?>
    <form action="" method="post">
        <label for="">Ingrese el numero de cedula</label>
        <input type="text" name="cedula" required placeholder="CI:">
        <label for="">Ingrese sus Nombres</label>
        <input type="text" name="nombres" required placeholder="Nombres">
        <label for="">Ingrese sus Apellidos</label>
        <input type="text" name="apellidos" required placeholder="Apellidos">
        <label for="">Ingrese su correo electronico</label>
        <input type="email" name="correo" required placeholder="email">
        <label for="">Ingrese el Cargo</label>
        <input type="text" name="cargo" required placeholder="Cargo">
        <label for="">Ingrese una contraseña para el Administrador</label>
        <input type="password" placeholder="password" name="password" required>
        <button type="submit">Ingresar</button>
    </form>
</div>