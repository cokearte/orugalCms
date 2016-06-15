<?php
/*
 * Archivo que realizara la carga del curriculum del usuario de la bolsa de empleo
 * @author: Farez Prieto
 * @date : 16 de Junio de 2010
 */
//die("entro");
//valido que venga el archivo
$tamano 	= $_FILES["archivo"]['size'];// tamaño
$tipo 		= $_FILES["archivo"]['type'];//tipo
$archivo	= $_FILES["archivo"]['name'];//nombre
//carpeta de los archivos
$carpeta	=	"../../curriculum/";
$nuevo_nombre	=	"curriculum_".date("Ymdhis").".pdf";
//Valido el tipo de archivo
if($tipo == 'application/pdf')//solo puede ser PDF
{
	$mensaje	= "Cargando...";
	if(copy($_FILES['archivo']['tmp_name'],$carpeta.$nuevo_nombre))
	{
		$mensaje	= "El archivo <b>".$nuevo_nombre."</b> Ha sido Cargado con Exito: ".display_filesize($tamano);
		echo '<script>window.top.recibir("'.$nuevo_nombre.'");</script>';

	}
	else
	{
		$mensaje	= "El archivo <b>".$nuevo_nombre."</b> No pudo ser cargado";
	}
	/*if(copy($_FILES['archivo']['tmp_name'],$destino))
			{*/ 
	//echo "El archivo cargado es correcto y pesa: ".display_filesize($tamano);
}
else
{
	$mensaje	= "Recuerde que solo se permiten archivos PDF";
}

echo $mensaje;

function display_filesize($filesize){
   
    if(is_numeric($filesize)){
    $decr = 1024; $step = 0;
    $prefix = array('Byte','KB','MB','GB','TB','PB');
       
    while(($filesize / $decr) > 0.9){
        $filesize = $filesize / $decr;
        $step++;
    }
    return round($filesize,2).' '.$prefix[$step];
    } else {

    return 'NaN';
    }
   
}

?>