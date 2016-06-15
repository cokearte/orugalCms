<?php 
global $db; 
global $funciones;
if(isset($_GET['padre']))
{
	$btnRegresar	=	true;
	//consulto los hijos del padre seleccionado
	$queryHijos		=	sprintf("SELECT * FROM principal as p, rel_usuario_producto as r WHERE p.id_padre=%s and p.id=r.id and r.idusuario='%s'",$_GET['padre'],$_SESSION['afiliado']['idusuario']);
	$archivos 		=	 $db->GetAll($queryHijos);
	//var_dump($archivos);
	$dataPadre 		=	$funciones->infoId($_GET['padre']);
}
else
{
	$queryVerific	=	sprintf("SELECT * FROM rel_usuario_producto as r, principal as p
							 WHERE r.idusuario=%s and p.id=r.id",$_SESSION['afiliado']['idusuario']);
	$resultado		=	$db->GetAll($queryVerific);
	$padre 			=	"";
	foreach($resultado as $padres)
	{
		$padre 	.=	$padres['id_padre'].",";
	}
	$padre 		=	substr($padre,0,strlen($padre)-1);
	$queryPadres	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id IN(%s)",$padre));
	$btnRegresar	=	false;
}


//al tener todos los archivos a los que el usuario se encuentra relacionado debo traer la informacion de los padres
?>
<link rel="stylesheet" type="text/css" href="<?php echo _DOMINIO?>php/afiliados/estilos.css">
<div class="contenedores">
	<div class="centros">
		<div class="centrosInt">
			<div style="float:left;width:100%;text-align:right">
				<div style="float:right;width:100%">
					<div style="float:left;width:50%;text-align:left">Bienvenido: <strong><?php echo $_SESSION['afiliado']['nombres'] ?> <?php echo $_SESSION['afiliado']['apellidos'] ?></strong><br></div>
					<div style="float:right;width:50%;text-align:right">
						<a href="<?php echo _DOMINIO ?>salidaAfiliado" style="color:#F0B116;font-size:0.9em;text-decoration:none">Cerrar Sesión</a>
					</div>
				</div>
			</div>
			<div style="float:left;width:100%;text-align:right;margin:20px 0 0 0;text-align:justify">
				<?php if(!isset($_GET['padre'])){ ?>
					<?php if(count($queryPadres) == 0){ ?>
						Aún no tienes archivos relacionados.
					<?php }else{ ?>
						<div style="border-bottom:1px dashed #999;float:left;width:100%;text-align:right;margin:0px 0 0 0;text-align:justify">
							<?php $cont=0;foreach($queryPadres as $carpetas){ $cont++;
									$tituloUrl	=	str_replace("á","a",strtolower($carpetas['titulo']));
									$tituloUrl	=	str_replace("é","e",$tituloUrl);
									$tituloUrl	=	str_replace("í","i",$tituloUrl);
									$tituloUrl	=	str_replace("ó","o",$tituloUrl);
									$tituloUrl	=	str_replace("ú","u",$tituloUrl);
									$tituloUrl	=	str_replace("ñ","n",$tituloUrl);
									$tituloUrl	=	str_replace(" ","-",$tituloUrl);
								?>	
									<div class="carpetas">
										<a href="<?php echo _DOMINIO ?>afiliados/<?php echo $tituloUrl ?>/<?php echo $carpetas['id'] ?>"><?php echo $carpetas['titulo'] ?></a>
									</div>
								<?php if($cont == 2){ $cont =0;?>
									</div>
									<div style="border-bottom:1px dashed #999;float:left;width:100%;text-align:right;margin:0px 0 0 0;text-align:justify">
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
				<?php }else{?>
					<?php if(count($archivos) == 0){ ?>
						Aún no tienes archivos relacionados.
					<?php }else{ ?>
						<div style="float:left;width:100%;text-align:right;margin:0px 0 0 0;text-align:justify;color:#444;font-size:0.9em;margin:0 0 10px 0">
							<a href="<?php echo _DOMINIO ?>afiliados" style="color:#5E8E19">Afiliados</a> > <?php  echo $dataPadre[0]['titulo'] ?>
						</div>
						<div style="border-bottom:1px dashed #999;float:left;width:100%;text-align:right;margin:0px 0 0 0;text-align:justify">
							<?php $cont=0;foreach($archivos as $files){ $cont++;
									$tituloUrl	=	str_replace("á","a",strtolower($files['titulo']));
									$tituloUrl	=	str_replace("é","e",$tituloUrl);
									$tituloUrl	=	str_replace("í","i",$tituloUrl);
									$tituloUrl	=	str_replace("ó","o",$tituloUrl);
									$tituloUrl	=	str_replace("ú","u",$tituloUrl);
									$tituloUrl	=	str_replace("ñ","n",$tituloUrl);
									$tituloUrl	=	str_replace(" ","-",$tituloUrl);
									$nombre_archivo = "../../archivos/".$files['adjunto']; // nombre archivo
									$peso_archivo = filesize($nombre_archivo); // obtenemos su peso en bytes

									$archivo = $files['adjunto']; 
									$trozos = explode(".", strtolower($archivo)); 
									$extension = end($trozos);
									
								?>	
									<div class="files">
										<a href="<?php echo _DOMINIO ?>archivos/<?php echo $files['adjunto'] ?>">
											<?php echo $files['titulo'] ?>
										</a><br>
										<span style="color:#999;font-size:0.9em"><i>Nombre Archivo: <?php echo basename("../../archivos/".$files['adjunto']) ?></i><br></span>
										<div class="btnDescarga" >
											<a href="<?php echo _DOMINIO ?>archivos/<?php echo $files['adjunto'] ?>" target="_blank" style="background-image:url(<?php echo _DOMINIO ?>php/afiliados/file/<?php echo $extension ?>.gif);background-repeat:no-repeat;background-position:3px 7px;">
												Descargar
											</a>
										</div>

										<!--<span style="color:#999;font-size:0.9em"><i>Tamaño: <?php echo tamano_archivo($peso_archivo); ?></i></span>
										<span style="color:#999;font-size:0.9em"><i>Tipo de Archivo: <?php echo mime_content_type("../../archivos/".$files['adjunto']); ?></i></span>-->
									</div>
								<?php if($cont == 2){ $cont =0;?>
									</div>
									<div style="border-bottom:1px dashed #999;float:left;width:100%;text-align:right;margin:0px 0 0 0;text-align:justify">
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>	



<?php
	function tamano_archivo($peso , $decimales = 2 ) {
	$clase = array(" Bytes", " KB", " MB", " GB", " TB"); 
	return round($peso/pow(1024,($i = floor(log($peso, 1024)))),$decimales ).$clase[$i];
	}
?>

