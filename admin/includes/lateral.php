<?
global $funciones;
global $db;

//debo empezar a consultar los modulos y las categorias que han sido creadas en el base de datos
$query 		=	sprintf("SELECT * FROM %s WHERE tipo_contenido in(1,2,3,4,5,6,7,0,13,17,19,10,16)",_TABLA_PRINCIPAL);
//traigo la informacion del sitio del usuario
$query_sites	=	$funciones->infoId($_SESSION['login']['telefono']);
$result 	=	$db->Execute($query);
//arreglo
$info		=	array();
//recorro para ponerlo en un arreglo
while(!$result->EOF)
{
	array_push($info,$result->fields);
	$result->MoveNext();
}
$usuario	=	$_SESSION['login'];
include(_PLANTILLAS.'interfaz/lateral.html');
?>