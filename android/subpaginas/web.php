<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <h2>Web de preguntas</h2>
</header>
<main>
    <?php
        $mysqli =new mysqli("localhost", "root", "", "android");
        $consulta = "select id,id_usuario,pregunta,valoracion from preguntas where respondido like 'no'";
        $res=$mysqli->query($consulta);
        $fila=$res->fetch_assoc();

        while($fila){
            $valoracion = $fila["valoracion"];

            if($valoracion=='verde'){
                $color = 'verde';
            }
            else if($valoracion=='amarillo'){
                $color = 'amarillo';
            }
            else if($valoracion=='rojo'){
                $color = 'rojo';
            }
            else{
                $color='defecto';
            }

            $id_usuario=$fila["id_usuario"];
            $id=$fila["id"];
            $select = "select nombre from usuarios where id like $id_usuario";
            $resselect=$mysqli->query($select);
            $filaselect=$resselect->fetch_assoc();
            $usuario=$filaselect["nombre"];
            echo "<div class='$color'><p>Nombre: ".$usuario."</p>";
            echo "<p>Pregunta: ".$fila["pregunta"]."</p>";
            echo "<a href='../APIs/respondida.php?id=$id'><button id=respondida>Respondida</button></a></div>";
            $fila=$res->fetch_assoc();
        }
    ?>
</main>
<script src="../js/jquery.js"></script>
<script src="../js/timer.js"></script>
</body>
</html>