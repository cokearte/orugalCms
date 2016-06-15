<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
//$info_id	=	$core->info_id;
$info_padre	=	$funciones->infoId($info_id[0]['id_padre']);
//$hijos		=	$core->info_id_hijos;
//debo empezar a hacer el proceso que me mostrara todos los eventos segun las fechas seleccionadas
/*
 * valido si viene la variable que me dira si son eventos nuevos o viejos
 * cuando sea 1 seran los eventos viejos
 * cuando sea 0 seran los eventos nuevos
 * cuando sea 2 sera por que selecciono un dia en especial
 */
if(isset($_GET['eventos']))
{
	$bandera	=	1;
	//valido el tipo de evento
	if($_GET['eventos'] == 0)//eventos nuevos
	{
		$ultimo_dia = date("t",mktime(0, 0, 0, date("m"), 1, date("Y")));
		$fecha_actual	=	date("Y-m-d");
		$fecha_final	=	date("Y-m-").$ultimo_dia;
		//realizo un query
		$query_eventos	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE fecha >= '%s' AND eliminado=0 AND visible=1 AND tipo_contenido=31 ORDER BY fecha DESC",$fecha_actual));
	}
	elseif($_GET['eventos'] == 1)//eventos viejos
	{
		$ultimo_dia = date("t",mktime(0, 0, 0, date("m"), 1, date("Y")));
		$fecha_actual	=	date("Y-m-d");
		$fecha_final	=	date("Y-m-")."1";
		//realizo un query
		$query_eventos	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE fecha <= '%s' AND eliminado=0 AND visible=1 AND tipo_contenido=31 ORDER BY fecha DESC",$fecha_actual));
	}
	elseif($_GET['eventos'] == 2)//dia en especial
	{
		$ultimo_dia = date("t",mktime(0, 0, 0, date("m"), 1, date("Y")));
		$fecha_actual	=	date("Y-m-").$_GET['dia'];
		//realizo un query
		$query_eventos	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE fecha = '%s' AND eliminado=0 AND visible=1 AND tipo_contenido=31 ORDER BY fecha DESC",$fecha_actual));
	}
}
else
{
	$bandera	=	0;
}

//debo poner en el home de eventos el ultimo agregado
$evento_maximo	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE tipo_contenido=31 AND visible=1 AND eliminado=0 ORDER BY fecha DESC LIMIT 1"));
?>
<div id="infoint">
    <div id="titint">
        <div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2">EVENTOS</div>
        </div>
      <?if($bandera == 0){ ?>  
      <div id="notip">
      <div id="tituloevent"><?=$evento_maximo[0]['titulo']?></div>
        <div id="fotononoti"><img src="images/<?=utf8_encode($evento_maximo[0]['imagen']) ?>" width="568" height="183" /></div>
        <div id="texnotip"><?=nl2br($evento_maximo[0]['resumen']) ?></div>
        <div id="ver">
        	<a href="index.php?id=<?=utf8_encode($evento_maximo[0]['id']) ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/diseno/vergaleria2.png',1)">
        		<img src="images/diseno/vergaleria1.png" name="Image16" width="92" height="18" border="0" id="Image16" />
        	</a>
        </div>
      </div>
      <?}else{ ?>
	      <div id="notip">
	        <?foreach($query_eventos as $lista_eventos){ ?>
		        <div class="pasados">
		       	  <div id="fotop"><img src="externos/Thumb.php?img=../images/<?=$lista_eventos['imagen'] ?>&tamano=144" width="144"/></div>
		          	<div id="titp"><?=$lista_eventos['titulo'] ?></div>
					<div id="textp"><?=substr($lista_eventos['resumen'],0,300)?></div>
		            <div id="ver">
		            	<a href="index.php?id=<?=$lista_eventos['id']?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/diseno/vergaleria2.png',1)">
		            		<img src="images/diseno/vergaleria1.png" name="Image16" width="92" height="18" border="0" id="Image16" />
		            	</a>
		            </div>
		        </div>
	        <?} ?>
	      </div>
      <?} ?>
     <?include("php/lateral_calendario.php") ?>
    </div>
    
    