<?php
ini_set("display_errors",0);
require_once('../config/configuracion.php');
require_once('../config/conexion_2.php');
require('../core/funciones.class.php');
$funciones = new funciones();
extract($_REQUEST);
if($accion == 1)
{
	$infoElemento	=	$funciones->infoId($id);
	echo json_encode($infoElemento[0]);
}
elseif($accion == 2)//buscador noticias
{
	$query		=	sprintf("SELECT *
					FROM principal
					WHERE
					MATCH (titulo, resumen) AGAINST ('%s')
					AND eliminado = 0
					AND visible = 1
					AND id_padre= '1235'
					ORDER BY id DESC",str_replace(" ",",",$_POST['cadena']));

	//echo $query;die();
	$listNoticias   =   $db->GetAll($query);

	$salida = "<div style='float:left;width:396px;padding:2px'>";
	foreach ($listNoticias as $key => $value) 
	{
		$tituloNoticiaUrl =  str_replace("á","a",strtolower($value['titulo']));
		$tituloNoticiaUrl =  str_replace("é","e",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("í","i",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("ó","o",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("ú","u",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("ñ","n",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("%","",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace("_","-",$tituloNoticiaUrl);
		$tituloNoticiaUrl =  str_replace(" ","-",$tituloNoticiaUrl);

		$salida .= "<div style='float:left;width:100%;margin:0 0 2% 0;border-bottom:1px dashed #999'>";
			$salida .= "<h3 style='margin:0 0 2% 0'>".$value['titulo']."</h3>";	
			$salida .= "<p>";
			if($value['imagen'] == "")
			{
				$salida .= "<img src='"._DOMINIO."images/diseno/noDisp.png' width='20%' style='float:left;margin:0 2% 2% 0'>";
			}
			else
			{
				$salida .= "<img src='"._DOMINIO."images/".$value['imagen']."' width='20%' style='float:left;margin:0 2% 2% 0'>";
			}

			$salida .= 	substr($value['resumen'],0,80)."..</p>";
			$salida .=  "<a href='"._DOMINIO.$tituloNoticiaUrl."/".$value['id']."#enterate' style='color:#6cb428'>Ver m&aacute;s</a>";
		$salida .= "</div>";
	}
	$salida .= "</div>";
	echo $salida;

}