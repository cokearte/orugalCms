<?php
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
global $db;
$funciones	=	new funciones();
$user		=	(isset($_GET['user']))?$_GET['user']:0;
$listado		=	$funciones->getProductoUsuario($user);
//recorro para sacar los campos que necesito
$listado_final	=	array();
foreach($listado as $info)
{
	$data	=	array("titulo"=>$info['titulo'],
	      "resumen"=>html_entity_decode(nl2br(utf8_encode($info['resumen']))),
		  "id"=>$info['id'],
	      "subtitulo"=>$info['subtitulo'],
	 	  "imagen"=>$info['imagen'],
		  "prom_votos"=>$funciones->obtenerPromedioVotos($info['id']));
	array_push($listado_final,$data);
}
$preferidos	=	$listado_final;
include('mi-lista.html');
?>