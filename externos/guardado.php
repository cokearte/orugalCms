<?php
//archivo de guardado de la calificacion
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../config/configuracion.php');
require_once('../config/conexion_2.php');

$id_votar		=	$_GET['cont'];
$calificacion	=	$_GET['calificacion'];

$tabla				=	'principal';
$condicion_query	=	sprintf('WHERE id=%s',$id_votar);
$campo_actualizar1	=	'puntaje';
$campo_actualizar2	=	'cantidad_votos';

//calculo  el puntaje
$query_puntaje		=	sprintf("SELECT * FROM %s %s",$tabla,$condicion_query);
$resultado_puntaje	=	$db->Execute($query_puntaje);

$puntaje			=	$resultado_puntaje->fields['puntaje'] + $calificacion;
$cantidad_votos		=	$resultado_puntaje->fields['cantidad_votos']	+	1;

if(!empty($id_votar))
{
	$query		=	sprintf("UPDATE %s SET %s='%s',%s='%s' %s",$tabla,$campo_actualizar1,$puntaje,$campo_actualizar2,$cantidad_votos,$condicion_query);
	$resultado	=	$db->Execute($query);
	if($resultado)
	{
		echo "La calificaci&oacute;n fue exitosa";
	}
	else
	{
		echo "La calificaci&oacute;n no se pudo llevar a cabo";
	}
}
else 
{
	echo "La calificaci&oacute;n no se pudo llevar a cabo";
}
?>