<?php

    include 'funciones.php';
    if (isset($_POST['submit'])){
      $resultado = [
        'error'=> false,
        'mensaje'=> 'El alumno ' . $_POST['nombre'] . ' ha sido agregado con éxito' 
      ];
      $config = include 'config.php';


     try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
         $alumnos = array(
            "nombre"   => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "edad"     => $_POST['edad'],
            "email"    => $_POST['email'],
         );

         $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
         $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";

         $sentencia = $conexion->prepare($consultaSQL);
        /* $sentencia->execute($alumnos);*/

        }catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
        }
    }      
?>

<?php include "template/header.php";?>

    <?php
    if  (isset($resultado)){
        ?>
            <div class ="container mt-3">
              <div class ="row">
                <div class="col-md-12">
                <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                   <?=$resultado['mensaje']?>
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
      <h2 class="mt-4">Crea un alumno</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="edad">Edad</label>
          <input type="text" name="edad" id="edad" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>