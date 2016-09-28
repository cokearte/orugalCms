<?php  
session_start();
extract($_REQUEST);
if($accion == 1)
{
	if($mov == 0)//quitar
	{
		unset($_SESSION['galeria'][$idFile]);
	}
	else
	{
		$_SESSION['galeria'][$idFile] = $dato;
	}

	if(count($_SESSION['galeria']) > 0)
	{
		$salida = array("continuar"=>1,
						"datos"=>$_SESSION['galeria']);
	}
	else
	{
		$salida = array("continuar"=>0,
						"datos"=>array());
	}

	echo json_encode($salida);
}
?>