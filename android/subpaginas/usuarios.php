<?php
$display="none";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $duplicado=$_POST["duplicado"];
    if($duplicado=="1"){
        $display="block";
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<header>
    <h1><a href="../index.html">Pregunta(me)</a></h1>
    <section id="cabecera">
        <span><a href="./web.php">Web ||</a></span>
        <span><a href="./usuarios.php">Usuarios ||</a></span>
        <span><a href="./datos.php">Estadísticas</a></span>
    </section>
    <h2>
        Creación de usuarios
    </h2>
</header>
<main id="usuarios">

    <form action="../APIs/usuarios.php" method="post">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id="nombre" required><br><br>
        <label for="contraseña">Contraseña</label><br>
        <input type="password" name="contraseña" id="contraseña" required><br><br>
        <button>Crear</button>
    </form>

</main>

<div id="usuario" style="display: <?=$display?>">
    <p>
        El usuario ya existe
    </p>
</div>

</html>