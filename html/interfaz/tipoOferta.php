<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
//var_dump($hijos);
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
        	<div class="vineta"><img src="images/diseno/ofer.png" width="26" height="20" /></div>
            <div class="texttit2"><h1>ofertas laborales</h1></div>
        </div>
        <div id="servicios2">
        <?foreach($hijos as $ofertas){ ?>
	   	  	<div class="oferta">
	            	<div id="empresa"><?=$ofertas['antetitulo'] ?>&nbsp;</div>
	                <div id="descripcion"><?=$ofertas['contenido'] ?>&nbsp;</div>
	          		<div class="cargo">Cargo</div>
	         	 	<div class="campoempl"><?=$ofertas['titulo'] ?>&nbsp;</div>
	                <div class="cargo">Salario</div>
	                <div class="campoempl"><?=$ofertas['alto'] ?>&nbsp;</div>
	                <div class="cargo">Contacto</div>
	              <div class="campoempl"><?=$ofertas['mail'] ?>&nbsp;</div>
	              <div class="cargo">Telefono</div>
	              <div class="campoempl"><?=$ofertas['telefono'] ?>&nbsp;</div>
	              <div class="cargo">Fecha</div>
	              <div class="campoempl"><?
	              	$fecha_final = explode(" ",$ofertas['fecha']);
	              	echo $fecha_final[0]; 
	              ?>&nbsp;</div>
	         </div>
         <?} ?>
        </div>
        <div id="banner_pub">
          <div id="eventolateral">
          	<img src="images/<?=$banner_lateral[0]['imagen'] ?>" width="163"/>
          </div>
      </div>
    </div>