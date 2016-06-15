<?
/*
* Repositorio de imagenes Black Image.
* @Author: Farez Prieto
* @Version: 2.0
*/
//incluyo los archivos de configuración del portal
//require_once("../configuracion/configuracion.php");

?>
<html>
<head>
<title>Repositorio de Archivos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
</style>
<style>
body{background-repeat:repeat-x;background-color:#FFFFFF;font-family: Arial, Helvetica, sans-serif;margin:0;padding:0;}
a{color:#a43a0c;text-decoration:none;font-size:12px;font-weight:bold}
input{border:1px solid #ccc}
</style>
</head>

<body>
<div id="form_carga">
	<form name="form1" action="upload.php" method="post" enctype="multipart/form-data">
		<table width="100%">
			<tr>
				<td colspan="2"><b>REPOSITORIO DE ARCHIVOS</b></td>
			</tr>
			<tr>
				<td>Seleccione el Archivo</td>
				<td><input name="archivo" type="file" size="35" /></td>
			</tr>
			<tr>
				<td>Escriba un nuevo nombre para el Archivo</td>
				<td>
					<input type="text" name="nombre_imagen" size="35">
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="ruta" value="<?echo $ruta=(isset($_GET['dir']))?$_GET['dir']:'../archivos/';?>">
				</td>
			</tr>
		   	<tr>
				<td colspan="2" align="center">
					<input name="enviar" type="submit" value="Subir Archivo">
					<input type="button" value="Cerra ventana" onClick="window.close()">
					<input name="action" type="hidden" value="upload">
				</td>
			</tr> 
		</table>
		
	</form> 
	<!-- 
	<form method="post">
		<table width="100%">
			<tr>
				<td>Escriba el nombre del nuevo folder</td>
				<td>
					<input type="text" name="nombre_folder">
					<input name="crear_folder" type="submit" value="Crear folder">
			</tr>			
		</table>	
	</form>
	 -->
</div>
	<?
	if(isset($_GET['dato']))
	{
		//$form	 =	"<form name='imagen' method='post'><input type='hidden' name='nombre_foto' value='".$_GET['dato']."'>";
		//$form	.=	"La imagen seleccionada <b> ".$_GET['dato']."</b>  <input type='button' onclick='parent.mostrar('".$_POST['nombre_foto'].")' value='Adjuntar imagen' name='adjuntar'></form>";
		$form =	sprintf("<script>parent.mostrar(%s)</script>",'"'.$_GET['dato'].'"');
		echo	$form;
		
	}

	if(isset($_GET['archivo']))
	{
		$ruta	=	(isset($_GET['dir']))?$_GET['dir']:'../images/';
		unlink($ruta.$_GET['archivo']);
		echo "<script>alert('el archivo ".$_GET['archivo']." ha sido borrado con exito');window.location='carga.php?dir=".$ruta."'</script>";
		
	}
	//verifico  si se esta creando una nueva carpeta
	if(isset($_POST['crear_folder']))
	{
		//capturo el nombre de la carpeta
		$nombre_carpeta	=	$_POST['nombre_folder'];
		//capturo la ruta donde se crara la carpeta
		$ruta=(isset($_GET['dir']))?$_GET['dir']:'../images/';
		//elimino cualquier clase de caracter especial, espacion etc, del nombre de la carpeta
		$nuevo_nombre	=	str_replace('á','a',$nombre_carpeta);
		$nuevo_nombre	=	str_replace('é','e',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('í','i',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('ó','o',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('ú','u',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('$','',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('/','',$nuevo_nombre);
		$nuevo_nombre	=	str_replace(' ','_',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('à','a',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('è','e',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('ì','i',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('ò','o',$nuevo_nombre);
		$nuevo_nombre	=	str_replace('ù','u',$nuevo_nombre);
		
		if(mkdir($ruta.$nuevo_nombre, 0777))
		{
			echo "<table align='center' style='background:#F3F1F2;border:1px solid #000'>
						<tr>
							<td>
								<image src='../repositorio/ok.jpg'>
							</td>
							<td>
								<div style='color:#000'>
									La carpeta<b>".$nuevo_nombre." </b>ha sido cargada con exito
								</div>
							</td>
						</tr>
						<tr>
							<td align='center' colspan='2'>
								<a href='carga.php?dir=".$ruta."'>
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
									<img src='../repositorio/cancel.png'> Error al crear la carpeta <b>".$nuevo_nombre.". </b>
								</div>
							</td>
						</tr>
						<tr>
							<td align='center' colspan='2'>
								<a href='carga.php?dir=".$ruta."'>
									Volver
								</a>
							</td>
						</tr>
					</table>";
		}
	}
	/*
	if(isset($_POST['adjuntar']))
	{
		echo "<script>parent.mostrar('".$_POST['nombre_foto']."')</script>";
	}*/

	/*
	if(isset($_POST['adjuntar']))
	{
		echo "<script>parent.mostrar('".$_POST['nombre_foto']."')</script>";
	}*/
	?>
	<? include("imagens.php");?><br>
</body>
</html>
