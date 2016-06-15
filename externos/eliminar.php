<?php
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require("../config/configuracion.php");
require("../config/conexion_2.php");
global $db;
extract($_GET);
//primero debo verificar si el usuario ya esta relacionado con el producto que selecciono.
$query			=	sprintf("DELETE FROM carrito_tmp WHERE producto_id=%s AND usuario_id='%s'",				
									$producto,
									$usuario);
									echo $query;
$result			=	$db->Execute($query);
if($result)
{
	echo "OK";
}
else
{
	echo "NO OK";
}
?>