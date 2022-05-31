<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos</title>
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
        Estadísticas sobre en número de preguntas
    </h2>
</header>
<main>
<?php
Error_reporting(0);

$mysqli = new mysqli("localhost", "root", "", "android");

$i = 8;

while($i<=14){
    $z = $i+1;

    //preguntas
    $select="select count(*) as total from preguntas where hora BETWEEN '$i:00:00' and '$z:00:00'";
    $resselect=$mysqli->query($select);
    $fila=$resselect->fetch_assoc();
    $total=$fila["total"];

    //id usuario más preguntas
    $maxpreguntas="select id_usuario,count(id_usuario) as npreguntas from preguntas where hora BETWEEN '$i:00:00' and '$z:00:00' GROUP BY id_usuario ORDER BY 2 DESC";
    $remaxpreguntas=$mysqli->query($maxpreguntas);
    $filamax=$remaxpreguntas->fetch_assoc();
    $id_usuariomax=$filamax["id_usuario"];
    $npreguntas=$filamax["npreguntas"];
    
    //nombre usuario
    $selectusuario="select nombre from usuarios where id like '$id_usuariomax'";
    $reselectusuario=$mysqli->query($selectusuario);
    $filausuariomax=$reselectusuario->fetch_assoc();
    $usuariomax=$filausuariomax["nombre"];

    if($usuariomax!=0){
        echo "<div><p>Entre las $i y las $z: <br> <br> $total preguntas</p><p>El usuario que más preguntas ha hecho es <strong>$usuariomax($npreguntas)</strong></p></div>";
    }
    else{
        echo "<div><p>Entre las $i y las $z: <br> <br> $total preguntas<p><small>No hay preguntas realizadas</small></p></p></div>";
    }

    $i++;
}
?>
</main>
</body>
</html>