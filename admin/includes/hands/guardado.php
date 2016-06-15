<?php
//cambiar por los archivos de BLACK
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../configuracion/configuracion.php');
require_once('../../configuracion/conexion_3.php');
//require_once(_RUTABASE.'_config/iniciar.php');
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 
$id_votar		=	$_GET['cont'];
$calificacion	=	$_GET['calificacion'];

$tabla				=	'principal';
$condicion_query	=	sprintf('WHERE id=%s',$id_votar);
$campo_actualizar	=	'calificacion';


if(!empty($id_votar))
{
	$query		=	sprintf("UPDATE %s SET %s=%s+%s %s",$tabla,$campo_actualizar,$campo_actualizar,$calificacion,$condicion_query);
	$resultado	=	$db->Execute($query);
	if($resultado)
	{
		echo "La calificaci&oacute;n fue exitosa";
	}
	else
	{
		echo "La calificación no se pudo llevar a cabo";
	}
}
else 
{
	echo "La calificación no se pudo llevar a cabo";
}
?>