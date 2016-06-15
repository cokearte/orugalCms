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
<div id="memoria">
	<h1><?=$info_id[0]['titulo'] ?></h1>
	<div id="miniFotos">
		<div class="contDobleRemi">
			<?foreach($hijos as $remis){ ?>
					<a href="index.php?id=<?=$remis['id'] ?>" title="<?=$remis['titulo'] ?>">
						<div class="contRemi">
							<div class="imagenRemi" style="background:#FFF url(externos/Thumb.php?img=../images/<?=$remis['imagen2'] ?>&tamano=296) no-repeat left 50%">
								<div class="infoRemi">
									<h2><?=$remis['titulo'] ?></h2>
									<!-- <div class="medio"><?=$remis['fecha'] ?></div>-->
								</div>	
							</div>
						</div>
					</a>
			<?} ?>	
		</div>
	</div>
</div>