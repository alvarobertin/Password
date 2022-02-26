<?php

function escapar($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'El empleado ' . escapar($_POST['nombre']) . ' ha sido agregado con éxito'
  ];

  $config = include '../conexion.php';
  try {

    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
    $bol = 0;
    if (isset($_POST['boletin'])){
        $bol = 1;
    }
    $empleado = array(
      "nombre"   => $_POST['nombre'],
      "correo"     => $_POST['correo'],
      "sexo"    => $_POST['sexo'],
      "area" => $_POST['area'],
      "boletin"    => $bol,
      "descr"    => $_POST['descr']
    );

    $consultaSQL = "INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion  ) values (:" . implode(", :", array_keys($empleado)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($empleado);

  } catch(PDOException $error) {    
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

