<?php
$nombre = $_POST["nombre"];
$contraseña = $_POST["contraseña"];
$mysqli = new mysqli("localhost", "root", "", "android");

$select="Select count(*) as nombre from usuarios where nombre like '$nombre'";
$resselect=$mysqli->query($select);
$fila=$resselect->fetch_assoc();
$nombrebd=$fila["nombre"];

if($nombrebd>=1){
    $postdata = http_build_query(
        array(
            'duplicado' => '1',
        )
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );

    $context = stream_context_create($opts);
    $result = file_get_contents('../subpaginas/usuarios.php', false, $context);
    echo $result;
}
else{
    $insert="INSERT INTO usuarios(nombre, contraseña) VALUES ('$nombre','$contraseña')";
    $mysqli->query($insert);
    header("Location: ../index.html");
}
?>