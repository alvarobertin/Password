<?php

function escapar($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
  }
$error = false;
$config = include 'conexion.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  $consultaSQL = "SELECT empleados.id as id, empleados.nombre as Enombre, 
                  areas.nombre as Anombre, email, sexo, area_id, boletin,
                   descripcion 
                FROM empleados JOIN areas ON empleados.area_id = areas.id";

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $empleados = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}
?>