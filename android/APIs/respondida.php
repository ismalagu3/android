<?php
$id = $_GET["id"];
$mysqli =new mysqli("localhost", "root", "", "android");
$consulta = "UPDATE preguntas set respondido='si' where id like $id";
$res=$mysqli->query($consulta);

header('Location: ../subpaginas/web.php');

?>