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
<?php echo "Bienvendo: ".$_SESSION["user"];
		include(_MENU_LATERAL);
?>
		<div id="cuerpo">
		<?php if($_SESSION["tipo"]==1){?>
				<fieldset><legend>Administrador.</legend>
						<br />
						
<a href="#" onclick="show_hide('insertanoticia')">Insertar Noticia.</a> 
<div id="insertanoticia" style="display:none; border:thin solid #999; padding: 1.5em" align="center"><font size="2px">
<form action="negocio/upload_noticia.php" method="post" name="f_inserta_noticia" enctype="multipart/form-data">
<table width="200" border="1">
		<tr>
				<td><strong>Titulo de la Noticia: </strong><br />
<input name="titulo" type="text" /></td>
				<td><strong>Resumen de la Noticia:</strong><br />
<input name="resumen" type="text" />
</td>
				<td>
</td>
		</tr>
		<tr>
		<td colspan="3">
		<strong>Descripcion de la Noticia:</strong><br />
		<textarea name="descripcion" cols="70" rows="3"></textarea>
		</td>
		</tr>
		<tr>
				<td><strong>Autor de la Noticia:</strong><br />
<input name="autor" type="text" />
</td>
				<td><strong>Email Autor:</strong><br />
<input name="email_autor" type="text" /></td>
				<td></td>
		</tr>
		<tr>
				<td colspan="3" align="center"><strong>Imagen a Cargar..</strong><br />
</td>
				
				

				<table>
                <tr><td colspan="3" align="center" bgcolor="#CCCCCC">DATOS ADJUNTOS</td></tr>
				
				
				</td><tr><td>
<input name="archivo" type="file" />
      
   				   </td></tr>
		</table>
</table>
<input name="fecha_inserta" type="hidden" value="<?php echo date("Y-m-d")?>" />
<input name="fecha_modifica" type="hidden" value="<?php echo date("Y-m-d")?>" />
<input name="envia_ingreso_noticia" type="submit" value="Ingresar Noticia" />
</form>

</font></table></div>
<br />
						<a href="#" onclick="show_hide('actualizarnoticia')">Listar, Actualizar o Eliminar Noticia.</a> 
<div id="actualizarnoticia" style="display:none; border:thin solid #999; padding: 1.5em" align="center"><font size="2px">

<form action="" method="post" name="f_actualiza_noticia">
<table width="200" border="1">
		<tr>
				<td>Titulo de la Notica a Buscar:<br />
<input name="titulo" id="titulo" type="text" />
</td>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td><input name="buscar_noticia" type="button" value="Buscar..." onclick="listarnoticia()" /></td>
				<td>&nbsp;</td>
		</tr>
		</table>
		<table width="200" border="1">
		
		<tr>
		<td ><div id="noticias"></div></td>
		</tr>
</table>
</form>
</div>	
						
						
						
				</fieldset>
		<?php }?>
		
		<!-- El contenedor que va a acomodar el menu y el contenido "principal" -->
		
    </div>		
        <div id="pie">
        </div>
<script language="javascript1.2" >
function listarnoticia(){
	//donde se mostrará lo resultados
	divResultado = document.getElementById('noticias');
 	titulo=document.getElementById('titulo').value;

 
	var miAleatorio=parseInt(Math.random()*99999999);
	ajax1=objetoAjax();
	ajax1.open("POST", "negocio/busca_noticias.php" + "?rand=" + miAleatorio,true);
	ajax1.onreadystatechange=function() {
		
		if (ajax1.readyState==4) {
			divResultado.innerHTML = ajax1.responseText			
		}
		else
    if (ajax1.readyState==1)
    {
	divResultado.innerHTML = "Procesando.... <img src='loader.gif'>";
    }
	}
	ajax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax1.send("titulo="+titulo)
}
</script>
</body>
</html>