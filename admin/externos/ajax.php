<?php 
session_start();
extract($_POST);
if($accion == 1)
{
	$url = str_replace("á","a",strtolower($texto));
	$url = str_replace("é","e",$url);
	$url = str_replace("í","i",$url);
	$url = str_replace("ó","o",$url);
	$url = str_replace("ú","u",$url);
	$url = str_replace("ñ","n",$url);
	$url = str_replace(" ","-",$url);
	$url = str_replace("_","-",$url);
	$url = str_replace(".","",$url);
	$url = str_replace("?","",$url);
	$url = str_replace("¿","",$url);
	$url = str_replace("!","",$url);
	$url = str_replace("¡","",$url);

	echo $url;
}
elseif($accion == 2)
{
	$sale = '';
	if(count($_SESSION['galeria']) > 0)
	{
		foreach($_SESSION['galeria'] as $llave=>$gal)
		{
			$sale .= '<div class="col-sm-6 col-xs-12 col-md-2 col-lg-2 text-left" style="position: relative" id="miniFoto'.$llave.'">
							<img width="100%" height="100px" class="thumbnail" style="float:left" src="../images/'.$gal.'" >
							<a style="position: absolute;top:0;right:10px;cursor:pointer;padding: 2%" class="glyphicon glyphicon-remove btn-warning selArchivo" onclick="quitarFoto('.$llave.',1)"></a>
					</div>	';
		}
		$salida = array("html"=>$sale,
						"txt"=>$_SESSION['galeria'],
						"continuar"=>1);
	}
	else
	{
		$salida = array("html"=>'',
						"txt"=>'',
						"continuar"=>0);
	}
	echo json_encode($salida);
}
elseif($accion == 3)
{
	if($eli == 1)//elimina el nodo deseado
	{
		unset($_SESSION['galeria'][$idFile]);
	}
	else //elimina todo
	{
		unset($_SESSION['galeria'])	;
	}
	echo "OK";
}
?>