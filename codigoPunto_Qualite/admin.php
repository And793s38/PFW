<?php
include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/modulos/navbar.inc.php";
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
      

      
      <h2 style="margin-top:10px">Clientes</h2>
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
      </div>
    
    
    
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
include_once $_SERVER['DOCUMENT_ROOT']."/20192B105/codigoPunto_Qualite/modulos/footer.php";
?>