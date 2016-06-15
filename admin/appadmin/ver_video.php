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
$publicidad	=	sprintf("SELECT * FROM principal WHERE id=%s AND eliminado=0 AND visible=1",$video);
//echo $publicidad; 
//ejecuto y recorro
$resultado	=	$db->Execute($publicidad);
?>
<html>
	<head>
		<title>
			Relacion de Videos a las Categorias
		</title>
		<style>
			 body{background:#fff;margin:auto;padding:auto}
			.titulo{text-align:center;font-weight:bold}
			td{border:1px solid #999}
		</style>
		
				<script src="../../js/flowplayer-3.2.2.min.js"></script>
	</head>
	<body>
	<center>
		<a href='../../archivos/<?=$resultado->fields['adjunto']?>' style="width:400px;height:300px;display:block"  id='player'><img src='../../images/<?=$resultado->fields['imagen']?>' width='400px' height='300px'></a>
		<script language="JavaScript">
			flowplayer("player", "../../swf/flowplayer-3.2.2.swf");
		</script>
	</center>
	</body>
</html>