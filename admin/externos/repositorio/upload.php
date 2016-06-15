<?
$status = "";
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    $tamano 	= $_FILES["archivo"]['size'];// tamaño
    $tipo 		= $_FILES["archivo"]['type'];//tipo
    $archivo	= $_FILES["archivo"]['name'];//nombre
    $nuevo_nombre=$_POST['nombre_imagen'];
    switch ($tipo )
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

    if($nuevo_nombre == '')
    {
    	$prefijo	=  $archivo	= $_FILES["archivo"]['name'];//nombre
    }
    else
    {
    	$prefijo	=	$nuevo_nombre.".".$extencion;
    }

	//capturo el directorio a examinar
	$dir	=	(isset($_POST['ruta']))?$_POST['ruta']."/":'../diseno/images/';
	//asigno la ruta donde se subira la imagen
	$destino =  $dir.$prefijo; 
	if ($archivo != "")
	{
       


			if(copy($_FILES['archivo']['tmp_name'],$destino))
			{ 
				echo "<table align='center' style='background:#F3F1F2;border:1px solid #000'>
						<tr>
							<td>
								<image src='../diseno/ok.jpg'>
							</td>
							<td>
								<div style='color:#000'>
									La imagen <b>".$prefijo." </b>ha sido cargada con exito
								</div>
							</td>
						</tr>
						<tr>
							<td align='center' colspan='2'>
								<a href='carga.php?dir=".$dir."'>
									Volver
								</a>
							</td>
						</tr>
					</table>";
	        }
	        else
	        {
	           
				echo "<table align='center' style='background:#fff;border:1px solid #000'>
						<tr>							
							<td>
								<image src='../diseno/error.png'>
							</td>
							<td>
								<div style='color:#ccc' valign='middle'>
									<img src='../diseno/cancel.png'> Error al subir el archivo <b>".$prefijo.". </b>
								</div>
							</td>
						</tr>
						<tr>
							<td align='center' colspan='2'>
								<a href='carga.php?dir=".$dir."'>
									Volver
								</a>
							</td>
						</tr>
					</table>";
	        }
	  
    }
    else
    {
        echo "<table align='center'>
				<tr>
					<td>
						<image src='../diseno/error.png'>
					</td>
					<td>
						<div style='color:#ccc' valign='middle'>
							Debe seleccionar un archivo!!
						</div>
					</td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<a href='carga.php?dir=".$dir."'>
							Volver
						</a>
					</td>
				</tr>
			</table>";
    }
} 
?>

