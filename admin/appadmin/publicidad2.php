<?php
ini_set("display_errors",0);
/*
 * Se maneja la asignacion de la publicidad para las secciones de la pagina
 * @author Farez Prieto
 * @date 11 de Octubre de 2010
 */
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
extract($_GET);
//query que me traera toda la publicidad de la pagina web
$publicidad	=	sprintf("SELECT * FROM principal WHERE tipo_contenido in(36,37) AND eliminado=0 AND visible=1");
//ejecuto y recorro
$resultado	=	$db->Execute($publicidad);
//arreglo con la informacion final
$datos_final	=	array();
//recorro el resultado
while(!$resultado->EOF)
{
	//ahora debo consultar a ver si la informacion resultante es igual a la que me traiga el sistema para la seccion seleccionada
	$query_seccion	=	$db->Execute(sprintf("SELECT * FROM relacion_banners WHERE seccion=%s AND banner=%s",$seccion,$resultado->fields['id']));
	//valido si me retorna datos
	if($query_seccion->NumRows() > 0)//quiere decir que la seccion esta relacionada con ese banner entonces creo el arreglo
	{
		$datos1	=	array("id"=>$resultado->fields['id'],
						  "titulo"=>$resultado->fields['titulo'],
						  "imagen"=>$resultado->fields['imagen'],
						  "adjunto"=>$resultado->fields['adjunto'],
						  "tipo_contenido"=>$resultado->fields['tipo_contenido'],
						  "existe"=>1);
	}
	else
	{
		$datos1	=	array("id"=>$resultado->fields['id'],
						  "titulo"=>$resultado->fields['titulo'],
						  "imagen"=>$resultado->fields['imagen'],
						  "adjunto"=>$resultado->fields['adjunto'],
						  "tipo_contenido"=>$resultado->fields['tipo_contenido'],
						  "existe"=>0);
	}
	//concateno el arreglo final
	array_push($datos_final,$datos1);
	$resultado->MoveNext();
}
//valido si se dio la orden de guardar
if(isset($_POST['asignar']))
{
	extract($_POST);
	//valido que halla seleccionado por lo menos un banner
	//borro todas las relaciones para esa seccion para insertar las nuevas
	$query_borrado	=	$db->Execute(sprintf("DELETE FROM relacion_banners WHERE seccion=%s",$seccion));
	//capturo el post
	$contador		=	0;
	foreach($banners as $data)
	{
		//ahora inserto la nueva relacion
		$query_insert	=	$db->Execute(sprintf("INSERT INTO relacion_banners(seccion,banner) VALUES('%s','%s')",$seccion,$data));
		if($query_insert)
		{
			$contador++;
		}
	}
	echo "<script>alert('Se relacionaron ".$contador." Banners a esta seccion');window.parent.closeShadow();</script>";
}
?>
<html>
	<head>
		<title>
			Relacion de Publicidad
		</title>
		<style>
			body{background:#fff}
			.titulo{text-align:center;font-weight:bold}
			td{border:1px solid #999}
		</style>
	</head>
	<body>
	<form method="post">
		<table width="500px" align="center" cellspacing="0" cellpadding="5">
			<tr>
				<td class="titulo">NOMBRE BANNER</td>
				<td class="titulo">BANNER</td>
				<td class="titulo">SELECCIONAR</td>
			</tr>
		<?foreach($datos_final as $banners){ ?>
			<tr>
				<td valign="top">
					<?=$banners['titulo'] ?>
				</td>
				<td>
					<?
						if($banners['tipo_contenido'] == 36)///imagen
						{
							echo "<img src='../../images/".$banners['imagen']."' width='189px' height='144px'>";
						}
						else
						{
							echo '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="189" height="144">
								  <param name="movie" value="../../archivos/'.$banners['adjunto'].'" />
								  <param name="quality" value="high" />
								  <embed src="../../archivos/'.$banners['adjunto'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="189" height="144"></embed>
								</object>';
						}
						
					?>
				</td>
				<td valign="top" align="center">
					<?if($banners['existe'] == 1){ ?>
						<input type="checkbox" checked name="banners[]" value="<?=$banners['id'] ?>">
					<?}else{ ?>
						<input type="checkbox" name="banners[]" value="<?=$banners['id'] ?>">
					<?} ?>
				</td>
			</tr>
			<?} ?>
			<tr>
				<td colspan="2">&nbsp;</td>
				<td align="center"><input type="submit" value="Asignar" name="asignar"></td>
			</tr>
		</table>
		</form>
	</body>
</html>