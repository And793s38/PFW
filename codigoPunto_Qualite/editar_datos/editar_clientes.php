<?php

include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/php-objects/usuario.inc.php";
session_start();
$var = true;
$sesion = $_SESSION['cliente'];
if(($sesion==null) || ($sesion->getCtipado() != 'a'))
{
  header("Location: /20192B105/index.php");
}

include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/modulos/navbar.inc.php";

if ($_POST) {

  //VARIABLES TOMADADAS POR EL METODO POST
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $dir = $_POST['direccion'];
  $ciu = $_POST['ciudad'];
  $pass = "usuario1234";
  $ctipoes = 'c';

  Conexion::abrir();
  //VERIFICACION DEL CORREO EXISTENTE
  $real = repositorioFunciones::obtener_usuario_email(Conexion::obtener(), $email);
  if ($real == null) {
      $new = date('Y-m-d', strtotime($_POST['fecha']));
      $usuario = new usuario('', $nombre, $new, $email, $pass, $dir, $ciu, $ctipoes);
      $newuser = repositorioFunciones::insertar_usuarios(Conexion::obtener(), $usuario);
      Conexion::cerrar();
      header('Location: /20192B105/codigoPunto_Qualite/admin.php');
  } else {
      $emailused = true;
  }
}
?>

  <div class="row" style="padding-top: 6em">
    
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/modulos/nav.php";
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
          <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
        </div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
          <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
        </div>
      </div>
      
      <section id="admin">
      <div class="container">
        <div class="row my-3">
          <div class="col-md-6">
            <div class="vision">
            <h2 id="type-blockquotes">Clientes</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div style = "text-align:right">
            <a href="editar_datos/editar_clientes.php">Editar</a>
            </div>    
          </div>
        </div>
      </div>
    </section>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Fecha de Nacimiento</th>
              <th>Email</th>
              <th>Direccion</th>
              <th>Tipo de cliente</th>
              <th>Ciudad</th>
            </tr>
          </thead>
          <tbody>
            <?php
              Conexion::abrir();
              $conex=Conexion::obtener();
              $i=1;
              while($i<=count(repositorioFunciones::obtener_usuarios($conex))){
                $usuario=repositorioFunciones::obtener_usuario_id($conex,$i);
                echo "<tr>";
                echo '<td>'.$usuario->getId().'</td>';
                echo '<td>'.$usuario->getNombre().'</td>';
                echo '<td>'.$usuario->getFecha_nacimiento().'</td>';
                echo '<td>'.$usuario->getEmail().'</td>';
                echo '<td>'.$usuario->getDireccion().'</td>';
                
                if($usuario->getCtipado()=='a'){
                echo '<td>Administrador</td>';
                }else{
                  echo '<td>Cliente</td>';
                }
                echo '<td>'. repositorioFunciones::obtener_ciudad($conex,$usuario->getFk_id_ciudad())->getNombre().'</td>';
                echo "</tr>";
                
                $i++;
              }
              Conexion::cerrar();
            ?>
            
          </tbody>
        </table>

    </main>
  </div>



  <script>
    window.sr = ScrollReveal();

    sr.reveal('.categoria-2', {
      duration: 2000,
      origin: 'left',
      distance: '300px'
    });
    sr.reveal('.imagen1-categoria1', {
      duration: 2000,
      origin: 'bottom',
      distance: '300px'
    });
    sr.reveal('.imagen2-categoria1', {
      duration: 2000,
      origin: 'bottom',
      distance: '300px'
    });
  </script>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/modulos/b_scripts.php";
?>