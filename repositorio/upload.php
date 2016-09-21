<?php
session_start();
require("../config/configuracion.php");
require("../config/conexion_2.php");
global $db;
ini_set("display_errors",1);
$status = "";
if(isset ($_FILES["archivo"])) 
{
	$archivos_no_cargados	=	array();
	$cargados				=	array();
   //de se asi, para procesar los archivos subidos al servidor solo debemos recorrerlo
   //obtenemos la cantidad de elementos que tiene el arreglo archivos
   $tot = count($_FILES["archivo"]["name"]);
   //este for recorre el arreglo
   for ($i = 0; $i < $tot; $i++)
   {
      //con el indice $i, poemos obtener la propiedad que desemos de cada archivo
      //para trabajar con este
      	$tamano 		= $_FILES["archivo"]['size'][$i];// tamaño
	    $tipo 			= $_FILES["archivo"]['type'][$i];//tipo
	    $archivo		= $_FILES["archivo"]['name'][$i];//nombre
	    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$nuevo_nombre = "";
		for($e=0;$e<12;$e++)
		{
			$nuevo_nombre .= substr($str,rand(0,62),1);
		}
		$dir	=	(isset($_POST['ruta']))?$_POST['ruta']."/":'../images/';
		 if($tipo == 'image/jpeg' or $tipo == 'image/png' or $tipo == 'image/gif' or $tipo == 'image/pjpg' or $tipo == 'image/x-png')
    	 {
    	 	switch ($tipo)
		    {
		    	case 'image/jpeg':
		    		$extencion	='jpg';
		    		break;
		    	case 'image/png':
		    		$extencion	='png';
		    		break;
		    	case 'image/gif':
		    		$extencion	='gif';
		    		break;
		    }
		    //nombre finbal
	    	$prefijo	=  $nuevo_nombre.".".$extencion;
	    	//ruta final
	    	$destino	=  $dir.$prefijo;
	    	if ($archivo != "")
			{
				if(copy($_FILES['archivo']['tmp_name'][$i],$destino))
				{ 
					array_push($cargados,$destino);
					//cuado se copeen los archivos los voy guardando en la base de datos
					$queryInsert = $db->Execute(sprintf("INSERT INTO repositorioimagenes (idpadre,nombre,tipo) VALUES('%s','%s','%s')",$_POST['padre'],$prefijo,2));
		        }
			}
			else
			{
				echo "Seleccione un archivo";
			}
    	 }
    	 else
    	 {
    	 	array_push($archivos_no_cargados,$archivo);
    	 }
   }
}
echo "<table align='center'>
		<tr><td>La carga de Im&aacute;genes ha finalizado <a href='carga.php?dir=".$_POST['padre']."'>
										Volver
									</a></td></tr>
	 </table>"; 
?>
