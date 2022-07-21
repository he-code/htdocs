<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/main.css">
    <title><?= $title?></title>
</head>
<body>
    <div class="container">
    <div class="header">
        <div class="img"><img src="/public/img/header.png" alt="MIES"></div>
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']) ): ?>
        <nav class="menu">
            <div  id="hamburger">
            <div class="hamburgesa"></div>
            </div>
            <ul id="menu-desplegable" class="hide">
                <a href="/">Inicio</a>
                <a href="/ingreso/productos-acta">Ingreso Material / Acta</a>
                <a href="/view/acta-salida">Generar Acta Salida</a>
                <a href="/add/admin">Ingresar Administrador</a>
                <a href="/baja">Darme de Baja</a>
                <a href="/salir" >Salir</a>
               
            </ul>
        </nav>
        <?php endif; ?>
    </div>
    <main class="main"><?= $content ?></main>
    <footer class="footer">
        &copy; Derechos reservados Dirección Distrital 02D02 Chillanes-Educación 2022 
    </footer>
    </div>
    <script src="/public/js/modules/html2pdf.js/dist/html2pdf.bundle.min.js"></script>
    <script src="/public/js/main.js" type="module" ></script>
</body>
</html>
