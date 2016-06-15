<?
/*
 * Cargue automatico de productos para el catalogo de Veerkamp.
 * @author Farez Jair Prieto Castro
 * @date  23 de Marzo de 2010
 * @version 1.0
*/
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
extract($_GET);
//realizo un query para activar el usuario
if($estado == 0)
{
	$query			=	sprintf("UPDATE concurso SET activo=1 WHERE id_concurso=%s",$id);
	$imagen			=	"eye.png";
	$estado_nuevo	=	1;
}
else
{
	$query			=	sprintf("UPDATE concurso SET activo=0 WHERE id_concurso=%s",$id);
	$imagen			=	"eye_cerrado.png";
	$estado_nuevo	=	0;
}
//ejecuto el query
$resultado	=	$db->Execute($query);
//si se guardo
if($resultado)
{
	echo "<a style='cursor:pointer' onClick='habilita(".$id.",".$estado_nuevo.")'><img src='images/".$imagen."' border='0'></a>";
}
else
{
	echo "bad";
}
?>