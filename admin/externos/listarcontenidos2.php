<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');

$valor	=	$_GET['valor'];
$caja	=	$_GET['caja'];

$query_jugadores	=	sprintf("SELECT * FROM marcas WHERE marca LIKE '%s' AND eliminado=0",'%'.$valor.'%');
//ejecuto el resultado
$result_jugadores	=	$db->Execute($query_jugadores);
//retorno el resultado
while(!$result_jugadores->EOF)
{
	echo	"<li><a href='#text' onClick=\"ponerCont(".$result_jugadores->fields['id'].",'".$caja."','".$result_jugadores->fields['marca']."')\">".$result_jugadores->fields['marca']."</a></li>";
	$result_jugadores->MoveNext();
}
?>
