<?php
global $id;
global $db;
global $funciones;
//Banners Aliados
$banersAli			=	$funciones->obtenerListado(1632);
//info Bienvenido
$bienvenido 		=   $funciones->infoId(1642);
//info Quienes Somos
$quienes 			=   $funciones->infoId(2);
include(_PLANTILLAS.'interfaz/home.html');
?>