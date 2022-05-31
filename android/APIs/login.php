<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){

    $data = file_get_contents('php://input');
    $datos = json_decode($data);
    $nombre=$datos->nombre;
    $password=$datos->password;

    $mysqli = new mysqli("localhost", "root", "", "android");
    $consulta = "select count(*) as n_usuario from usuarios where nombre like '$nombre' and contraseña like '$password'";
    $res=$mysqli->query($consulta);
    $fila=$res->fetch_assoc();

    $numero=$fila["n_usuario"];

    if ($numero==1){
        echo "correcto";
    }
    else{
        echo "incorrecto";
    }
}
else{
    echo "error";
}
?>