<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){

    $data = file_get_contents('php://input');
    $datos = json_decode($data);
    $pregunta=$datos->pregunta;
    $valoracion=$datos->boton;
    $nombre=$datos->nombre;

    $mysqli = new mysqli("localhost", "root", "", "android");

    $select="select id from usuarios where nombre like '$nombre'";
    $resselect=$mysqli->query($select);
    $fila=$resselect->fetch_assoc();
    $id_usuario=$fila["id"];

    $insert="INSERT INTO preguntas(id_usuario,pregunta,valoracion) VALUES ('$id_usuario','$pregunta','$valoracion')";
    $mysqli->query($insert);
}
else{
    echo "error";
}
?>