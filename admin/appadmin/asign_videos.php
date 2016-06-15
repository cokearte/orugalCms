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
//si dan la orden de buscar
if(isset($_POST['enviar_busqueda']))
{
	$filtro		=	sprintf("AND titulo like '%s'","%".$_POST['buscar']."%");
}
else
{
	$filtro		=	'';
}
//query que me traera toda la publicidad de la pagina web
$publicidad	=	sprintf("SELECT * FROM principal WHERE tipo_contenido in(10) AND eliminado=0 AND visible=1 %s ORDER BY fecha DESC",$filtro);
//echo $publicidad; 
//ejecuto y recorro
$resultado	=	$db->Execute($publicidad);
//arreglo con la informacion final
$datos_final	=	array();
//recorro el resultado
while(!$resultado->EOF)
{
	//die(sprintf("SELECT * FROM relacion_contenidos WHERE id_padre=%s AND id=%s",$seccion,$resultado->fields['id']));
	//ahora debo consultar a ver si la informacion resultante es igual a la que me traiga el sistema para la seccion seleccionada
	$query_seccion	=	$db->Execute(sprintf("SELECT * FROM relacion_contenidos WHERE id_padre=%s AND id=%s",$seccion,$resultado->fields['id']));
	//echo sprintf("SELECT * FROM relacion_contenidos WHERE id_padre=%s AND id=%s",$seccion,$resultado->fields['id']);
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
	$query_borrado	=	$db->Execute(sprintf("DELETE FROM relacion_contenidos WHERE id_padre=%s",$seccion));
	//capturo el post
	$contador		=	0;
	foreach($banners as $data)
	{
		//ahora inserto la nueva relacion
		$query_insert	=	$db->Execute(sprintf("INSERT INTO relacion_contenidos(id_padre,id) VALUES('%s','%s')",$seccion,$data));
		if($query_insert)
		{
			$contador++;
		}
	}
	echo "<script>alert('Se relacionaron ".$contador." Videos a esta categoria');window.parent.closeShadow();</script>";
}
?>
<html>
	<head>
		<title>
			Relacion de Videos a las Categorias
		</title>
		<style>
			 body{background:#fff}
			.titulo{text-align:center;font-weight:bold}
			td{border:1px solid #999}
		</style>
		<script type="text/javascript" src="../highslide/highslide.js"></script>
		<link rel="stylesheet" type="text/css" href="../highslide/highslide.css" />
		
		
		<!--
		    2) Optionally override the settings defined at the top
		    of the highslide.js file. The parameter hs.graphicsDir is important!
		-->
		
		<script type="text/javascript">
		    hs.graphicsDir = '../highslide/graphics/';
		    hs.outlineType = null;
		    hs.wrapperClassName = 'colored-border';
		</script>
	</head>
	<body>
	<form method="post">
		<table width="500px" align="center" cellspacing="0" cellpadding="5">
			<tr>
				<td colspan="3" align="center">
					<b>Filtrar por Nombre</b> <input type="text" name="buscar" placeholder="Buscar..."><input type="submit" name="enviar_busqueda" value="Buscar">
				</td>
			</tr>
			<tr>
				<td class="titulo">NOMBRE DEL VIDEO</td>
				<td class="titulo">VISTA PREVIA</td>
				<td class="titulo">SELECCIONAR</td>
			</tr>
		<?foreach($datos_final as $banners){ ?>
			<tr>
				<td valign="top">
					<?=$banners['titulo'] ?>
				</td>
				<td align="center">
				<script src="../../js/flowplayer-3.2.2.min.js"></script>
				<script>
					function agrandar(id)
					{
						document.getElementById('player'+id).style.width="400px";
						document.getElementById('player'+id).style.height="300px";
						document.getElementById('player'+id).style.display='block';
						//document.getElementById('player'+id).style.z-index='250';
					}
				</script>
					<?
						echo "<a href='../../archivos/".$banners['adjunto']."'  id='player".$banners['id']."' class='highslide' onclick='agrandar(".$banners['id'].")'><img src='../../images/".$banners['imagen']."' width='60px' height='50px'>";
					?>
					<script language="JavaScript">
						flowplayer("player<?=$banners['id'] ?>", "../../swf/flowplayer-3.2.2.swf");
					</script>
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