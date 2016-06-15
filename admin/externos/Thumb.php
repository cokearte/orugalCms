<?php
/*
*	Archivo de imagenes Miniatura
*	Version 2.0
*	Esta version me permite generar imagenes miniatura con los tipos PNG, GIF y JPG
*	Autor: Farez Prieto
*	Fecha creacion: 24 de Febrero de 2009
*/
//capturo las variables que se envian por GET
//variable del ancho 
$anchura	=	$_GET['tamano'];
//ruta de la imagen
$nombre		=	$_GET['img'];
//se crea el arreglo con los datos de la imagen
$datos 		= 	getimagesize($nombre);

//ancho de la imagen
$width 	= $datos[0];
//alto de la imagen
$height = $datos[1];

//captro el tamaño que le paso por GET
$t_width = $anchura;
//calculo la proporcion del alto
$proporcion = $t_width / $width;
//asigno el alto de la imagen
$t_height = $proporcion * $height;
//valido si es una imagen gif
if($datos[2]==1)
{
	$img = @imagecreatefromgif($nombre);
}
//valido si es una imagen jpg
if($datos[2]==2)
{
	$img = @imagecreatefromjpeg($nombre);
}
//valido si es una imagen png
if($datos[2]==3)
{
	$img = @imagecreatefrompng($nombre);
}
//creo la miniatura con el alto y el ancho antes calculado
$thumb = imagecreatetruecolor($t_width,$t_height);
//copia la imagen manteniendo  una buena calidad
imagecopyresampled($thumb, $img, 0, 0, 0, 0, $t_width, $t_height, $datos[0], $datos[1]);
/*
$black = imagecolorallocate($thumb, 250, 250, 255);
imagestring($thumb, 6, $t_width-200, $t_height-20, 'Derechos reservados'._TITULO_PAGINA_DB, $black);*/
//valido si es una imagen  gif
if($datos[2]==1)
{	
	//si es gif creo la correspondiente imagen
	header("Content-type: image/gif"); imagegif($thumb);
}
//valido si es jpg
if($datos[2]==2)
{
	//si es jpg creo la correspondiente imagen
	header("Content-type: image/jpeg");imagejpeg($thumb);
}
//valido si es png
if($datos[2]==3)
{
	//si es png realizo la respectiva imagen
	header("Content-type: image/png");imagepng($thumb); 
}
//destruyo el buffer
imagedestroy($thumb);

?>