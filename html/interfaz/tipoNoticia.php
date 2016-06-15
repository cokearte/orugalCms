<?
ini_set('display_errors',1);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
$hijos	=	$core->info_id_hijos;
//realizo un query con la ultima noticia
$ultima_noticia_creada	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE tipo_contenido=17 ORDER BY fecha DESC",$id));
?>
<div id="infoint">
    	<div id="titint">
        	<div class="vineta"><img src="images/diseno/reloj.png" width="21" height="21" /></div>
            <div class="texttit2">novedades</div>
        </div>
      <div id="notip">
      	<div id="tituloevent"><?=$ultima_noticia_creada[0]['titulo']?></div>
        <div id="fotononoti">
        	<!--<img src="externos/Thumb.php?img=../images/<?=$ultima_noticia_creada[0]['imagen']?>&tamano=568" width="568" />-->
        	 <?if(empty($ultima_noticia_creada[0]['adjunto'])){?>
        			<img src="externos/Thumb.php?img=../images/<?=$ultima_noticia_creada[0]['imagen'] ?>&tamano=568" width="568" />
      		  <?}else{ ?>
		        	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="568" height="305">
					  <param name="movie" value="archivos/<?=$ultima_noticia_creada[0]['adjunto']?>" />
					  <param name="quality" value="high" />
					  <embed src="archivos/<?=$ultima_noticia_creada[0]['adjunto']?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="568" height="305"></embed>
					</object>
       		 <?} ?>
       	</div>
        <div id="texnotip"><?=html_entity_decode($ultima_noticia_creada[0]['contenido'])?></div>
       <!--  <div id="ver"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/diseno/vermas2.png',1)"><img src="images/diseno/vermas1.png" name="Image10" width="92" height="18" border="0" id="Image10" /></a></div>-->
      </div>
      <div id="menunoti">
      	<?foreach($hijos as $datos){ ?>
      		<div class="mennoti">
      			<a href="index.php?id=<?=$datos['id']?>"><?=$datos['titulo']?></a>   
      		</div>
      	<?} ?>
      </div>
    </div>