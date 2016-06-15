<?
global $funciones;
global $core;
global $id;
global $migas;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
//saco el producto del mes
$producto_mes	=	$funciones->getProductoMes();
$oferta_mes		=	$funciones->getOfertaMes();
include(_PLANTILLAS.'interfaz/default2.html');
?>