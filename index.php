<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Password</title>
	<link rel="stylesheet" href="../css/listar.css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" type="text/javascript"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5208fbe466.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "listar.php"; ?>


<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="Ingresar/index.php"  class="btn btn-primary mt-4">Crear Empleado</a>
      <hr>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Lista de empleados</h2>
      <table class="table">
        <thead>
          <tr>
            <th><i class="fa-solid fa-user"></i> Nombre </th>
            <th><i class="fa-solid fa-at"></i>Email</th>
            <th><i class="fa-solid fa-venus-mars"></i>Sexo</th>
            <th><i class="fa-solid fa-toolbox"></i>Área</th>
            <th><i class="fa-solid fa-envelope"></i>Boletín</th>
            <th>Modificar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($empleados && $sentencia->rowCount() > 0) {
            foreach ($empleados as $fila) {
              ?>
              <tr>
              <!-- print_r(array_keys($fila));  -->
                <td><?php echo escapar($fila["Enombre"]); ?></td>
                <td><?php echo escapar($fila["email"]); ?></td>
                <td><?php echo escapar($fila["sexo"]); ?></td>
                <td><?php echo escapar($fila["Anombre"]); ?></td>
                <td>
                    <?php 
                    if (escapar($fila["boletin"]) == "1"){
                        echo "Si"; 
                    }else{
                        echo "No";
                    }
                    ?>
                </td>
                <td>
                    <a href="<?= 'modificar.php?id=' . escapar($fila["id"]) ?>" > 
                        <i class="fa-solid fa-pen-to-square"></i> 
                    </a>
                </td>
                <td>
                    <a href="<?= 'eliminar.php?id=' . escapar($fila["id"]) ?>" onclick="return confirm('¿Desea borrar el empleado?')">
                        <i class="fa-solid fa-trash"></i> 
                    </a>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>


</body>
</html>

