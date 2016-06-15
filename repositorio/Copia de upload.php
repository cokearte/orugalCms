<?
$status = "";
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    $tamano 	= $_FILES["archivo"]['size'];// tamaño
    $tipo 		= $_FILES["archivo"]['type'];//tipo
    $archivo	= $_FILES["archivo"]['name'];//nombre
    $nuevo_nombre=$_POST['nombre_imagen'];
    //directorio
	//capturo el directorio a examinar
	$dir	=	(isset($_POST['ruta']))?$_POST['ruta']."/":'../images/';
    if($tipo == 'image/jpeg' or $tipo == 'image/png' or $tipo == 'image/gif')
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
	
	    if($nuevo_nombre == '')
	    {
	    	$ref		=	explode(".",$_FILES["archivo"]['name']);	
	    	$prefijo	=  $archivo	= $ref[0].rand(0,1000).".".$ref[1];//nombre
	    }
	    else
	    {
	    	$prefijo	=	$nuevo_nombre.".".$extencion;
	    }
		//asigno la ruta donde se subira la imagen
		$destino =  $dir.$prefijo; 
		if ($archivo != "")
		{
				if(copy($_FILES['archivo']['tmp_name'],$destino))
				{ 
					echo "<table align='center' style='background:#F3F1F2;border:1px solid #000'>
							<tr>
								<td>
									<image src='../repositorio/ok.jpg'>
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
									<image src='../repositorio/error.png'>
								</td>
								<td>
									<div style='color:#ccc' valign='middle'>
										<img src='../repositorio/cancel.gif'> Error al subir el archivo <b>".$prefijo.". </b>
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
							<image src='../repositorio/error.png'>
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
							</tr>d>
					</tr>
				</table>";
	    }
    }
    else
    {
    	echo "<table align='center'>
					<tr>
						<td>
							<image src='../repositorio/error.png'>
						</td>
						<td>
							<div style='color:#ccc' valign='middle'>
								Solo se permiten archivos en formato JPG, GIF y PNG
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

