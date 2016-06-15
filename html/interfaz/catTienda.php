<?
/*
 * Archivo que controla el proceso de las tiendas
 * @author Farez Prieto
 * @date 17 de Noviembre de 2010
 */
global $funciones;
global $core;
global $id;
global $migas;
$producto_mes	=	$funciones->infoId(568);
$local_mes		=	$funciones->infoId(570);
$hijos	=	$core->info_id_hijos;
?>
<div id="infoint">
    	<div id="titint">
        	<div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2"><h1>TIENDAS</h1></div>
        </div>
        <div id="tiendas">
        <?foreach($hijos as $datos){?>
	   	   	 <div class="tiendas">
	            	<div id="foto_tienda">
		            	<a href="index.php?id=<?=$datos['id']?>#contenido" title="<?=utf8_encode($datos['titulo'])?>">
		            		<img src="images/<?=$datos['imagen']?>" width="140" height="80" />
		            	</a>
	            	</div>
	                <div id="tit_tienda">
	                	<a href="index.php?id=<?=$datos['id']?>#contenido" title="<?=utf8_encode($datos['titulo'])?>">
	                		<?=$datos['titulo']?>
	                	</a>
	                </div>
	          </div>
          <?}?>
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