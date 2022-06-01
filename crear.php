<?php
    include 'funciones.php';

    if (isset($_POST['submit'])) {
       //acciones a  realizar 

       $resultado =[
        /*array resultado despues de hacer la carga*/
        'error' => false,
        'mensaje' => 'El alumno ' . escapar($_POST['nombre']) . ' ha sido agregado con éxito'
      ];
      $config = include 'config.php';

      try{

        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        /// codigo de insercion de alumno  .
        $alumno = [
          "nombre"   => $_POST['nombre'],
          "apellido" => $_POST['apellido'],
          "email"    => $_POST['email'],
          "edad"     => $_POST['edad'], 
          /**crear un array con los datos del nuevo alumno, que obtendremos del array $_POST: */
        ];


        $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
        //$consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";

        /*el método prepare y a ejecutar la consulta:*/
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($alumno);

      }catch(PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
      }   
    }
       
  ?>
<?php
if (isset($resultado)){
  /* notificacion en donde mostraremos un error, de haberlo, o un mensaje de éxito si el alumno se ha insertado correctamente:*/
  ?>
  <div class = "container mt-3">
    <div class ="row">
      <div class = "col-md-12">
      <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php include "template/header.php";?>

<div class="container">
              
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un alumno</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nomapbre</label>
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

<?php include "template/footer.php"; ?>