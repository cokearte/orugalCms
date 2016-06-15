<?
//ini_set("display_errors",1);
$status = "";
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    $tamano 	= $_FILES["archivo"]['size'];// tamaño
    $tipo 		= $_FILES["archivo"]['type'];//tipo
    $archivo	= $_FILES["archivo"]['name'];//nombre
	
    $prefijo	=	str_replace(' ','_',$archivo);
	$prefijo	=	str_replace('á','a',$prefijo);
	$prefijo	=	str_replace('é','e',$prefijo);
	$prefijo	=	str_replace('í','i',$prefijo);
	$prefijo	=	str_replace('ó','o',$prefijo);
	$prefijo	=	str_replace('ú','u',$prefijo);
	$prefijo	=	str_replace('Á','a',$prefijo);
	$prefijo	=	str_replace('É','e',$prefijo);
	$prefijo	=	str_replace('Í','i',$prefijo);
	$prefijo	=	str_replace('Ó','o',$prefijo);
	$prefijo	=	str_replace('Ú','u',$prefijo);
	$prefijo	=	str_replace('ñ','n',$prefijo);
	$prefijo	=	str_replace('Ñ','n',$prefijo);

	if ($archivo != "")
	{
       
		$destino =  "../archivos/".$prefijo; 


			if(copy($_FILES['archivo']['tmp_name'],$destino))
			{ 
				echo "<table align='center'><tr><td><div style='color:#264F77'>El archivo <b>".$prefijo." </b>ha sido cargada con exito<br><br><a href='carga.php'>Volver</a></div></td></tr></table>";
		   	
	        }
	        else
	        {
	           
				echo "<table align='center'><tr><td><div style='color:#264F77'><img src='../diseno/cancel.png'> error al subir el archivo <b>".$prefijo.". </b></div></td></tr></table>";
	        }
	  
    }
    else
    {
        echo "<table align='center'><tr><td><div style='color:#264F77'><img src='../diseno/cancel.png'> Debe seleccionar un archivo!!<br><br><a href='carga.php'>Volver</a></div></td></tr></table>";
    }
} 
?>

