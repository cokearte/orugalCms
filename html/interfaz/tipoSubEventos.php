<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
//$info_id	=	$core->info_id;
//$hijos		=	$core->info_id_hijos;
?>
<div id="infoint">
    <div id="titint">
        <div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2">EVENTOS</div>
        </div>
      <div id="notip">
      	<div id="tituloevent"><?=$info_id[0]['titulo']?></div>
      	<div id="texnotip"><?=$info_id[0]['resumen']?></div>
        <div id="galeria_eventos">
        	<?foreach($hijos as $galeria){ ?>
	        	<?if(!empty($galeria['imagen'])){?>
	       	  		<div class="fotog">
	       	  			<a href="images/<?=$galeria['imagen'] ?>" rel="shadowbox[datos]" title="<?=utf8_encode($galeria['titulo']) ?>">
	       	  				<img src="images/<?=$galeria['imagen'] ?>" alt="<?=utf8_encode($galeria['titulo']) ?>" width="150" height="100" border="0"/>
	       	  			</a>
	       	  		</div>
	       	  	<?} ?>
       	  	<?} ?>
        </div>
       <!--  <div id="ver"><a href="galeria_eventos.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/vergaleria2.png',1)"><img src="images/vergaleria1.png" name="Image16" width="92" height="18" border="0" id="Image16" /></a></div>-->
      </div>
     <?include("php/lateral_calendario.php") ?>
    </div>