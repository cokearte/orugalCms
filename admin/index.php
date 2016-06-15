<?php
/*
* Administrador de contenidos desarrollado por 
* Farez Prieto @orugal 
* http://www.twitter.com/orugal
* Todos los derechos reservados
*/
ini_set("display_errors",0);
session_start();
require('../config/configuracion.php');
require('../config/conexion_2.php');
require('../core/funciones.class.php');
//objeto de la clase funciones
$id				=	(isset($_GET['id']))?$_GET['id']:1;
//valido si esta editar
if(isset($_GET['editar']))
{
	$editar	=	true;
}
else
{
	$editar	=	false;
}
$funciones	=	new Funciones();
$seguridad	=	$funciones->iniciaSeguridad();
$tipo_id	=	$funciones->infoId($id);
//valido si esta loguedo el usuario
//unset($_SESSION['login']);
if(!isset($_SESSION['login']))
{
	$logueado	=	false;
}
else
{
	$logueado	=	true;
}

//valido si se dio la orden de cerrar session
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
	echo "<script>document.location='index.php'</script>";
}
$titulo_pagina		=	$funciones->obtenerTitulo($id);

include(_PLANTILLAS.'interfaz/index.html');
?>