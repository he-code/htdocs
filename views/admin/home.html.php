<?php 
    if(isset($_SESSION['user'])){
        header('location: /inicio');
        exit();
    }
?>
<div class="formus">
    <?php if (isset($error)): ?>
        
    <div class="error">
        <?= $error ?> 
    </div>

    <?php endif ?>
    <form action="" method="post">
        <label for="">Ingrese su correo electronico</label>
        <input type="email" name="correo" required placeholder="email">
        <label for="">Ingrese su contraseña</label>
        <input type="password" placeholder="password" name="clave" required>
        <button type="submit">Ingresar</button>
    </form>
</div>