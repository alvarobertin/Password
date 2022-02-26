<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ingresar</title>
	<link rel="stylesheet" href="../css/ingresar.css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" type="text/javascript"></script>

    <script src="../js/form-validation.js"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
    <h1>Crear Empleado</h1>

	<div class="form-holder">
        <div class="alert alert-primary" role="alert">
            Los campos con asteriscos (*) son obligatorios
        </div>
        <form class="form-inline" name="ingreso" id="ingreso" method="POST" action="">
            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label>Nombre completo *</label>
                </div>
                <div class="col-sm-4">
                    <input name="nombre" type="text" class="form-control" placeholder="Nombre completo del empleado">                
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label >Correo Electronico *</label>
                </div>
                <div class="col-auto">
                    <input name="correo" type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Correo electrónico">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label >Sexo *</label>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value="M" checked>
                        <label class="form-check-label" for="gridRadios1">
                          Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value="F">
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
                        <option value="1">Ventas</option>
                        <option value="2">Calidad</option>
                        <option value="3">Produccion</option>
                    </select>

                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="descr">Descripción de la experiencia del empleado*</label>
                </div>
                <div class="col-auto">
                    <textarea class="form-control" name="descr" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="exampleFormControlTextarea1"></label>
                </div>
                <div class="col-auto">
                    <input type="checkbox" class="form-check-input" name="boletin" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Deseo recibir boletín informativo</label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 col-form-label">
                    <label for="exampleInputEmail1">Roles *</label>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="gridRadios1" value="1" checked>
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


            <input type="submit" name="submit" class="btn btn-primary"></input>
        </form>
	</div>

</body>
</html>

<?php 

include "ingresar.php";

  

?>