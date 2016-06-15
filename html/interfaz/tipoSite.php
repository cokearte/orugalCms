<?php
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
require('config/configuracion.php');
global $funciones;
global $core;
global $id;
global $migas;
if(isset($_GET['hijo']))
{
  $info_id  = $funciones->infoId($_GET['hijo']);
  $hijos    = $funciones->obtenerListado($_GET['hijo']);
  $ssql     = sprintf("SELECT * FROM principal WHERE id_padre=%s AND eliminado=0 AND id !=%s AND visible=1 ORDER BY fecha DESC",$_GET['hijo'],$_GET['hijo']);
  $mostrarFoto  = true;
  $miga     = $funciones->BusquedaRecursiva($_GET['hijo'],array());
}
else
{
  $info_id	=	$core->info_id;
  $hijos		=	$core->info_id_hijos;
  $ssql     = sprintf("SELECT * FROM principal WHERE id_padre=%s AND eliminado=0 AND id !=%s AND visible=1 ORDER BY fecha DESC",$id,$id);
  $mostrarFoto  = false;
  $miga     = array();
}

$paging=new PHPPaging;
$paging->paginasAntes(6);
$paging->paginasDespues(6);
if($_GET['ver'])
{
  $e_ssql=mysql_query($ssql);
  $numver=mysql_num_rows($e_ssql);
}
else
{
  $numver=4;
}
$paging->porPagina($numver);
$paging->agregarConsulta($ssql);
$paging->ejecutar();
if(!$paging->numTotalRegistros())
{
  $no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
}
$links = $paging->fetchNavegacion();

?>
<div class="contenedores">
<div class="centros">
        <div class="centrosInt infoInteres">
          <?php if(count($miga) > 0){?>
            <div class="infoInteresInterno">
              <ul class="miga">
                <?php foreach($miga as $migas){ ?>
                  <?php if($migas['id'] != 10 and $migas['id'] != 0){ ?>
                    <?php if($migas['id'] == 1){?>
                      <li>
                        <a href="home"><?php echo $migas['titulo'] ?></a> > 
                      </li>
                    <?php }elseif($migas['id'] == 13){?>
                      <li>
                        <a href="informacion-interes"><?php echo $migas['titulo'] ?></a> > 
                      </li>
                    <?php }elseif($migas['id'] == 11){?>
                      <li>
                        <a href="informacion-gremial"><?php echo $migas['titulo'] ?></a> > 
                      </li>
                    <?php }else{ ?> 
                      <li>
                       <?php echo $migas['titulo'] ?>
                      </li>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>
          <h2><?php echo strip_tags($info_id[0]['titulo']) ?></h2>
          <div class="infoInteresInterno">
            <?php if($mostrarFoto){ ?>
              <?php if(trim($info_id[0]['imagen']) == ""){ ?>
                  <img src="<?php echo _DOMINIO ?>images/diseno/noDisp.png" style="float:left;margin:0 3% 3% 0;width:40%">
              <?php }else{ ?>
                  <img src="<?php echo _DOMINIO ?>images/<?php echo $info_id[0]['imagen'] ?>" style="float:left;margin:0 3% 3% 0;width:40%">
              <?php } ?>
            <?php } ?>
            <?php echo strip_tags($info_id[0]['resumen']) ?>
          </div>
          <?php if(isset($_GET['hijo'])){?>
          <div class="infoInteresInterno">
            <div class="textoInfoInt" style="width:100%;text-align:right">
              <div class="textoInfoMini" style="width:100%;text-align:right">
                <?php  $info_id[0]['adjunto']  = str_replace("../","",$info_id[0]['adjunto']);
                      $urlescarga1 = _DOMINIO.$info_id[0]['adjunto'];?>
                <?php if($info_id[0]['adjunto'] != ""){ ?><a target="_blank" title="Ver Adjunto" href="<?php echo $urlescarga1 ?>">Descargar</a> |<?php } ?> 
                <?php if($info_id[0]['link'] != ""){ ?><a target="_blank" title="Ver Enlace" href="<?php echo $info_id[0]['link'] ?>">Visitar Enlace</a> | <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(count($hijos) > 0){ ?>
              <?php $contador=1;while($hijosInt = $paging->fetchResultado()){ 
                  $hijosInt['adjunto']  = str_replace("../","",$hijosInt['adjunto']);
                  $urlescarga = _DOMINIO.$hijosInt['adjunto'];
                  $tituloEnlace   = str_replace("á","a", strtolower($hijosInt['titulo']));
                  $tituloEnlace   = str_replace("é","e", $tituloEnlace);
                  $tituloEnlace   = str_replace("í","i", $tituloEnlace);
                  $tituloEnlace   = str_replace("ó","o", $tituloEnlace);
                  $tituloEnlace   = str_replace("ú","u", $tituloEnlace);
                  $tituloEnlace   = str_replace("ñ","n", $tituloEnlace);
                  $tituloEnlace   = str_replace(" ","_", $tituloEnlace);
                  $tituloEnlace   = str_replace(".","_", $tituloEnlace);
                  $linkNoticia    = $tituloEnlace."-".$hijosInt['id'];

                ?>
              <?php if($contador == 1){ ?>
               <div class="infoInteresInterno">
              <?php } ?>
                <!--mini paquetes de info Interna-->
                <div class="contMiniInfo">
                  <div class="fotoInfoInt">
                  <?php if(trim($hijosInt['imagen']) == ""){ ?>
                      <img src="<?php echo _DOMINIO ?>images/diseno/noDisp.png">
                  <?php }else{ ?>
                    <img src="<?php echo _DOMINIO ?>images/<?php echo $hijosInt['imagen'] ?>">
                  <?php } ?>
                    
                  </div>
                  <div class="textoInfoInt">
                    <h3 title="<?php echo $hijosInt['titulo'] ?>"><?php echo substr($hijosInt['titulo'],0,50) ?>...</h3>
                    <div class="textoInfoMini"><?php echo substr(strip_tags($hijosInt['resumen']),0,180) ?>...</div>
                    <div class="textoInfoMini">
                      <?php if($hijosInt['adjunto'] != ""){ ?><a target="_blank" title="Ver Adjunto" href="<?php echo $urlescarga ?>">Descargar</a> |<?php } ?> 
                      <?php if($hijosInt['link'] != ""){ ?><a target="_blank" title="Ver Enlace" href="<?php echo $hijosInt['link'] ?>">Visitar Enlace</a> | <?php } ?>
                      <a title="Ver M&aacute;s" href="<?php echo $linkNoticia ?>">Ver M&aacute;s</a>
                    </div>
                  </div>
                </div>
                  <?php if($contador == 2){ $contador=0?>
                </div>
                <?php } ?>
              <!--fin mini paquetes de info Interna-->
              <?php $contador++;} ?>
            <?php } ?>
            <div class="infoInteresInterno">
              <div class="paginador">P&aacute;ginas: <?php $links   = $paging->fetchNavegacion();echo $links;?></div>
            </div>
        </div>

      </div>
      <div class="centros">
        <div class="centrosInt">
          <img src="<?php echo _DOMINIO ?>images/diseno/slogan.png"  />
        </div>
      </div>
</div>      