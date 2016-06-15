<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
$producto_mes	=	$funciones->infoId(568);
$local_mes		=	$funciones->infoId(570);
//$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
?>
<div id="infoint">
    	<div id="titint">
        	<div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2">
          <h1>centro de negocios</h1></div>
        </div>
        <div style="width:600px;float:left">
	        <?foreach($hijos as $datos){ ?>
			<div class="areas">
	        	<div id="fotoareas">
	        	<?if(!empty($datos['imagen'])){?>
	        		<img src="images/<?=utf8_encode($datos['imagen'])?>" width="209" height="117" />
	        	<?} ?>	
	        	</div>
	            <div id="titareas"><b><h1><?=utf8_encode($datos['titulo'])?></h1></b></div>
	            <!-- <div id="texareas"><?=utf8_decode($datos['resumen'])?></div>-->
	            <div id="ver">
	            	<a href="index.php?id=<?=$datos['id']?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','images/diseno/vermas2.png',1)">
	            		<img src="images/diseno/vermas1.png" name="Image11" width="92" height="18" border="0" id="Image11" />
	            	</a>
	            </div>
	        </div>
	        <?} ?>
        </div>
        <div id="banner_pub">
        	<div id="eventolateral">
        		<img src="images/<?=$banner_lateral[0]['imagen'] ?>" width="163"/>
        	</div>
          <div id="localmes">
           	  	<div id="titlm">LOCAL MES</div>
                <div id="fotomes"><img src="images//<?=$local_mes[0]['imagen']?>" width="165" /></div> 
          </div>
          <div id="promes">
           	  <div id="titpm">PRODUCTO DEL MES</div>
                <div id="fotopm">
                	<img src="images/<?=$producto_mes[0]['imagen']?>" width="165" />
				</div>
          </div>
      </div>
    </div>