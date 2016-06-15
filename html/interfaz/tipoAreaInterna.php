<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
//$info_id	=	$core->info_id;
//$hijos		=	$core->info_id_hijos;
//hijos areas comunes
$listado	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre='%s' AND id not in(%s)",16,$id));
?>
<script>	
function ponerImagen(imagen,div)
{
	//Shadowbox.clearCache(); // <= clear Shadowbox's cache
	// <= set up all Shadowbox links 
	document.getElementById(div).innerHTML = '<a href="'+imagen+'" rel="Shadowbox;"><img border="0" src="'+imagen+'" width="209" /></a>';
	Shadowbox.setup(); 
}
</script>
<div id="infoint">
    	<div id="titint">
        	<div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2">
          <h1>centro de negocios</h1></div>
        </div>
        
        <div id="internas">
        	<div id="continternas">
            	<div id="fotointernas">
	            	<?if(!empty($info_id[0]['imagen'])){?>
	            		<a href="images/<?=$info_id[0]['imagen']?>" rel="Shadowbox;"><img border="0" src="images/<?=$info_id[0]['imagen']?>" width="218" /></a>
	            	<?} ?>	
            	</div>
               	<div id="mini_fotos">
               		<?if(!empty($info_id[0]['imagen2'])){?><img src="images/<?=$info_id[0]['imagen2']?>" width="90px" onClick="ponerImagen('images/<?=$info_id[0]['imagen2']?>','fotointernas')"><?} ?>
               		<?if(!empty($info_id[0]['imagen3'])){?><img src="images/<?=$info_id[0]['imagen3']?>" width="90px" onClick="ponerImagen('images/<?=$info_id[0]['imagen3']?>','fotointernas')"><?} ?>
               		<?if(!empty($info_id[0]['imagen4'])){?><img src="images/<?=$info_id[0]['imagen4']?>" width="90px" onClick="ponerImagen('images/<?=$info_id[0]['imagen4']?>','fotointernas')"><?} ?>
               	</div>
            </div>
          <div id="guia">
         		 <div id="titinternas2"><?=$info_id[0]['titulo'] ?></div>
        		 <div id="texinterna2"><?=$info_id[0]['contenido']?></div>
             </div>
        </div>
      <div id="meninternas">
        	<div id="contac">
            	<div class="vineta"><img src="images/diseno/contactenos.png" width="26" height="24" /></div>
            	<div class="texttit2"><h1>contactenos</h1></div>
            </div>
            <div id="menareas">
            	<ul id="menupro"> 
            		<?foreach($listado as $lateral){ ?>
         	 			<li><a href="index.php?id=<?=$lateral['id'] ?>"><?=utf8_encode($lateral['titulo'])?></a></li>
         	 		<?} ?>	
          		</ul>
        </div>
            <div id="empleo"><a href="ofertas_laborales.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image12','','images/diseno/empleo2.png',1)"><img src="images/diseno/empleo1.png" name="Image12" width="192" height="35" border="0" id="Image12" /></a></div> 
       	  <div id="eventolateral"></div>
      </div>
    </div>