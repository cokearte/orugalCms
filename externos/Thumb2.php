<?php
/*
*	Archivo de imagenes Miniatura tomando cierta parte
*	Version 2.0
*	Esta version me permite generar imagenes miniatura con los tipos PNG, GIF y JPG
*	Autor: Farez Prieto
*/
// Abre la imagen
//$_GET["img"]	=	str_replace("/",'\\',$_GET["img"]);
$fichero = getcwd()."/".$_GET["img"];
//echo $fichero; 
if (preg_match('/.png$/', $fichero)) {
$img = imagecreatefrompng($fichero);
} else if (preg_match('/.gif$/', $fichero)) {
$img = imagecreatefromgif($fichero);
} else if (preg_match('/.jpg$/', $fichero)) {
$img = imagecreatefromjpeg($fichero);
}
$xini = 0;
$yini = 0;
$xfin = 300;
$yfin = 340;
$res = imagecreatetruecolor($xfin-$xini, $yfin-$yini);
imagecopy($res, $img, 0, 0,$xini, $yini,$xfin-$xini, $yfin-$yini);
header("Content-type: image/png");
imagepng($res);
?>