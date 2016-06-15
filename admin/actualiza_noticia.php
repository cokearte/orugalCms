<?php session_start();
require('includes/application.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="<?=_STYLES?>" rel="stylesheet" type="text/css">
<title><?= _TITLE_PAGE?> Inicio Administrador <?php echo " - ".$_SESSION["user"]?></title>
<script language="JavaScript" src="includes/varios_archivos.js"></script>
<script language="JavaScript" src="negocio/ajax.js"></script>
<script language="JavaScript" src="includes/mostrar_ocultar.js"></script>
</head>
<body>
	<div id="contenedor">
	
		<?php
			include(_ENC);
		?>
		<!-- El contenedor principal "contenedor" -->			
<?php echo "Usuario Activo: ".$_SESSION["user"];
		include(_MENU_LATERAL);
?>
		<div id="cuerpo">
		 <?php 
include "negocio/conexion.php"; 
$conexion = conectar();

$sql="SELECT * FROM noticia WHERE id='". $_POST["id"]."'";

$consulta=ejecutar_consulta($sql, $conexion);
while ($row=pasar_a_array($consulta))
{

?>

		<!-- El contenedor que va a acomodar el menu y el contenido "principal" -->
		<form action="" method="post" name="actualiza_noticia">
		<table width="200" border="1">
		<tr>
				<td><strong>Titulo de la Noticia: </strong><br />
<input name="titulo" type="text" value="<?php echo $row["titulo"];?>" /></td>
				<td><strong>Resumen de la Noticia:</strong><br />
<input name="resumen" type="text" value="<?php echo $row["resumen"];?>" />
</td>
				<td>
</td>
		</tr>
		<tr>
		<td colspan="3">
		<strong>Descripcion de la Noticia:</strong><br />
		<textarea name="descripcion" cols="70" rows="3"><?php echo $row["descripion"];?></textarea>
		</td>
		</tr>
		<tr>
				<td><strong>Autor de la Noticia:</strong><br />
<input name="autor" type="text" value="<?php echo $row["autor"];?>" />
</td>
				<td><strong>Email Autor:</strong><br />
<input name="email_autor" type="text" value="<?php echo $row["email_autor"];?>" /></td>
				<td></td>
		</tr>
<tr><td colspan="3" align="center" bgcolor="#CCCCCC">DATOS ADJUNTOS</td></tr>
		</table>
		</form>
<?php }?>
    </div>		
        <div id="pie">
        </div>
</body>
</html>