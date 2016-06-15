<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');

$valor	=	$_GET['valor'];
$caja	=	$_GET['caja'];
$filtro	=	$_GET['filtro'];
if($filtro != 0)
{
	$query_jugadores	=	sprintf("SELECT * FROM principal WHERE titulo LIKE '%s' AND visible=1 AND eliminado=0 AND tipo_contenido=%s OR codproducto LIKE '%s' AND visible=1 AND eliminado=0 AND tipo_contenido=%s",'%'.$valor.'%',$filtro,'%'.$valor.'%',$filtro);
}	
else
{
	$query_jugadores	=	sprintf("SELECT * FROM principal WHERE titulo LIKE '%s' AND visible=1 AND eliminado=0 OR codproducto LIKE '%s' AND visible=1 AND eliminado=0",'%'.$valor.'%','%'.$valor.'%');
}
//echo $query_jugadores;
//ejecuto el resultado
$result_jugadores	=	$db->Execute($query_jugadores);
//retorno el resultado
while(!$result_jugadores->EOF)
{
	echo	"<li><a href='#text' onClick=\"ponerCont(".$result_jugadores->fields['id'].",'".$caja."','".utf8_encode($result_jugadores->fields['titulo'])."')\">".utf8_encode($result_jugadores->fields['titulo'])." <b>(".$result_jugadores->fields['id'].")</b></a></li>";
	$result_jugadores->MoveNext();
}
?>
