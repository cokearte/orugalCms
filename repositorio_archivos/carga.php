<html>
<head>
<title>Repositorio de Archivos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
</style>
<script>
function formCarga()
{
	document.getElementById('form_carga').style.display='';
}
function noMostrar()
{
	document.getElementById('form_carga').style.display='none';
}
</script>
</head>

<body>
<input type="button" value="Cargar Archivo" onclick="formCarga()">
<div id="form_carga" style="display: none">
	<form name="form1" action="upload.php" method="post" enctype="multipart/form-data">
		<table bgcolor="#ECE2AD" width="100%">
			<tr>
				<td colspan="2" style="color:#000"><b>SUBIR UN ARCHIVO</b></td>
			</tr>
			<tr>
				<td style="color:#000">Seleccione el archivo</td>
			</tr>
			<tr>
				
				<td><input name="archivo" type="file" size="35" /></td>
			</tr>
			<tr>
				<td colspan="2"><input name="enviar" type="submit" value="Subir Archivo"><input  type="button" value="Cancelar" onClick="noMostrar()"></td>
			</tr>
		   		
		</table>
		<input name="action" type="hidden" value="upload">
	</form> 
</div>
	<?
	if(isset($_GET['archivo']))
	{
		unlink('archivos/'.$_GET['archivo']);
		echo "<script>alert('el archivo ".$_GET['archivo']." ha sido borrado con exito');window.location='carga.php'</script>";
		
	}
	/*
	if(isset($_POST['adjuntar']))
	{
		echo "<script>parent.mostrar('".$_POST['nombre_foto']."')</script>";
	}*/
	?>
	<? include("archivos.php");?>
	<br>
	<input type="button" value="Cerra ventana" onClick="window.close()">
</body>
</html>
