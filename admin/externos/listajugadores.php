<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');

$valor	=	$_GET['valor'];
$caja	=	$_GET['caja'];

$query_jugadores	=	sprintf("SELECT * FROM principal WHERE tipo_contenido=10 AND titulo LIKE '%s'",'%'.$valor.'%');
//ejecuto el resultado
$result_jugadores	=	$db->Execute($query_jugadores);
//retorno el resultado
while(!$result_jugadores->EOF)
{
	echo	"<li><a href='#text' onClick=\"ponerId(".$result_jugadores->fields['id'].",".$caja.",'".$result_jugadores->fields['titulo']."')\">".$result_jugadores->fields['titulo']."</a></li>";
	$result_jugadores->MoveNext();
}
?>
