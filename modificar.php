<?php
function escapar($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
  }

$config = include 'conexion.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'Ocurrio un problema editando el empleado';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $bol = 0;
    if (isset($_POST['boletin'])){
        $bol = 1;
    }
    $empleado = [
        "id"        => $_GET['id'],
        "nombre"   => $_POST['nombre'],
        "correo"     => $_POST['correo'],
        "sexo"    => $_POST['sexo'],
        "area" => $_POST['area'],
        "boletin"    => $bol,
        "descr"    => $_POST['descr']
    ];
    $consultaSQL = "UPDATE empleados SET
        nombre = :nombre,
        email = :correo,
        sexo = :sexo,
        area_id = :area,
        boletin = :boletin,
        descripcion = :descr
        WHERE id = :id";
    
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($empleado);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM empleados WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $empleado = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$empleado) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado el empleado';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

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
<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            El empleado ha sido actualizado correctamente
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($empleado) && $empleado) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el empleado <?= escapar($empleado['nombre'])  ?></h2>
        <hr>
  <div class="form-holder">
        <div class="alert alert-primary" role="alert">
            Los campos con asteriscos (*) son obligatorios
        </div>
        <form class="form-inline" method="POST" >
            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label>Nombre completo *</label>
                </div>
                <div class="col-sm-4">
                    <input name="nombre" type="text" class="form-control" 
                    placeholder="Nombre completo del empleado"
                    value="<?= escapar($empleado['nombre']) ?>" >                
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label >Correo Electronico *</label>
                </div>
                <div class="col-auto">
                    <input name="correo" type="email" class="form-control"  
                    placeholder="Correo electrónico"
                    value="<?= escapar($empleado['email']) ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label >Sexo *</label>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value="M" 
                        <?php if($empleado['sexo'] == "M") {echo "checked";}?>>
                        <label class="form-check-label" for="gridRadios1">
                          Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value="F"
                        <?php if($empleado['sexo'] == "F") {echo "checked";}?>>
                        <label class="form-check-label" for="gridRadios2">
                          Femenino
                        </label>
                    </div>                
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="inlineFormCustomSelect">Área *</label>
                </div>
                <div class="col-auto">
                    <select class="custom-select mr-sm-2" name="area">
                        <option value="1" <?php if($empleado['area_id'] == 1) {echo "Selected";}?>>Ventas</option>
                        <option value="2" <?php if($empleado['area_id'] == 2) {echo "Selected";}?>>Calidad</option>
                        <option value="3" <?php if($empleado['area_id'] == 3) {echo "Selected";}?>>Produccion</option>
                    </select>

                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="descr">Descripción de la experiencia del empleado*</label>
                </div>
                <div class="col-auto">
                    <textarea class="form-control" name="descr" value="<?= escapar($empleado['descripcion']) ?>" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="exampleFormControlTextarea1"></label>
                </div>
                <div class="col-auto">
                    <input type="checkbox" class="form-check-input" name="boletin" id="exampleCheck1" <?php if($empleado['boletin'] == 1) {echo "checked";}?>>
                    <label class="form-check-label" for="exampleCheck1">Deseo recibir boletín informativo</label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="exampleInputEmail1">Roles *</label>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="gridRadios1" value="1" >
                        <label class="form-check-label" for="gridRadios1">
                            Profesional de Proyectos - Desarrollador
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="gridRadios2" value="2">
                        <label class="form-check-label" for="gridRadios2">
                            Gerente estratégico
                        </label>
                    </div>      
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="gridRadios2" value="3">
                        <label class="form-check-label" for="gridRadios2">
                            Auxiliar administrativo
                        </label>
                    </div>          
                </div>
            </div>


            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar"></input>
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </form>
      </div>
    </div>
  </div>

  <?php
}
?>

</body>
