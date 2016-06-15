<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
?>
<div id="memoria">
	<h1><?=$info_id[0]['titulo'] ?></h1>
	<!-- <h4><?=$info_id[0]['fecha'] ?></h4>-->
	
	<div id="miniFotos">
		<p><?=$info_id[0]['resumen'] ?></p>
		<div id="fotoRemi">
			<div id="subFotoRemi">
				<?if($info_id[0]['imagen2'] != ''){?>
					<div id="clip"></div>
					<div id="infoRemi">
						<!--<img src="images/<?=$info_id[0]['imagen2']?>" width="100px"/>-->
					</div>
				<?} ?>
				<img src="images/<?=$info_id[0]['imagen'] ?>" width="500px"/>
			</div>	
		</div>
	</div>
</div>