<?php
ini_set("display_errors",0);
/*
 * Apicativo que controla el funcionamiento de los usuarios de Veerkamp
 */
global $db;
require("../core/phpmailer/class.phpmailer.php");
global $funciones;
//capturo la accion que venga en este momento
//accion 1 quiere decir usuario del portal
//accion 2 quiere decir usuarios de la bolsa
$accion		=	(isset($_GET['accion']))?base64_decode($_GET['accion']):0;
$filtro		=	'';

	 //valido si se dio la orden de filtrar
	 if(isset($_POST['buscar']))//filtrar los usuarios
	 {
	 	extract($_POST);
		if(!empty($_POST['nombre']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" nombre LIKE '%".$_POST['nombre']."%'";
		}
	 	if(!empty($_POST['cedula']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" cc = '".$_POST['cedula']."'";
		}
	 }
	 elseif(isset($_POST['exportar']))//exportar los usuarios
	 {
	 	extract($_POST);
		if(!empty($_POST['nombre']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" nombre LIKE '%".$_POST['nombre']."%'";
		}
	 	if(!empty($_POST['cedula']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" cc LIKE '".$_POST['cedula']."'";
		}
		//die($filtro);
		$query_exportar	=	$db->GetAll(sprintf("SELECT * FROM peugeot WHERE  %s",$filtro));
		echo "<script>alert('Se exportara el excel');document.location='externos/exporta_usuarios4.php?filtro=".base64_encode($filtro)."'</script>";
		
	 }
	 else
	 {
		 //valido si se dio la orden de eliminar
		if(isset($_POST['accion']))
		{
			//realizo el query de borrado
			$query_borrado	=	$db->Execute(sprintf("DELETE FROM peugeot WHERE id in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM peugeot WHERE id in(%s)",implode(',',$_POST['elim'])));
			if($query_borrado)
			{
				echo "<script>alert('Los usuarios seleccionados se han borrado con exito');document.location='index.php?id=".$id."&accion=".$_GET['accion']."'</script>";
			}
			else
			{
				echo "<script>alert('Los usuarios seleccionados no se han borrado');</script>";
			}
		}
	 }
	 if(!empty($filtro))
	 {
	 	 $query_usuarios	=	$db->Execute(sprintf("SELECT * FROM peugeot WHERE  %s ORDER BY id DESC",$filtro));
	 	// echo sprintf("SELECT * FROM concurso WHERE  %s",$filtro);
	 }
	 else
	 {
		 $query_usuarios	=	$db->Execute(sprintf("SELECT * FROM peugeot ORDER BY id DESC")); 	
	 }
	//var_dump($query_usuarios);
	 $array_users		=	array();
	 //recorro y armo el listado de estos usuarios
	 while(!$query_usuarios->EOF)
	 {
	 	array_push($array_users,$query_usuarios->fields);
	 	$query_usuarios->MoveNext();
	 }
?>
<style>
	.titulos{font-weight:bold;text-align:center;text-transform:uppercase}
</style>
<!-- Call shadowbox scripts //-->
<link rel="stylesheet" type="text/css" href="../shadowbox-3.0.3/shadowbox.css">
<script type="text/javascript" src="../shadowbox-3.0.3/shadowbox.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="js/objetoajax.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript">
Shadowbox.init({
    handleOversize: "drag",
    modal: true
});
</script>
<script type="text/javascript"><!--
	function closeShadow()
	{
		Shadowbox.close();
	}
// --></script>
<script>
	function confirmar()
	{
		if(confirm("Esta seguro que desea borrar los usuarios seleccionados?") == true)
		{
			document.form.submit();
		}
		else
		{
			return false;
		}
	}
function generarClave(id_user,accion,id)
{
	if(confirm("Se va a generar una clave para este usuario, Desea continuar?")==true)
	{
		document.location="index.php?id="+id+"&genera="+id_user;
	}
	else
	{
		return false;
	}
}

function habilita(id,estado)
{
	if(confirm("Esta seguro que desea cambiar el estado del usuario?") == true)
	{
		ruta_archivo	=	"externos/habilita.php";
		//instancio el objeto ajax
		ajax=nuevoAjax();
		//paso los parametros por get al php
		ajax.open("GET", ruta_archivo+"?id="+id+"&estado="+estado);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1)
			{
				$('#ojo'+id).html("<img src='images/ajax-loader_mini.gif'");
			}
			else if (ajax.readyState==4)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				$('#ojo'+id).html(resultado);
				
			}
		}
		ajax.send(null);
	}
	else
	{
		return false;
	}
}
</script>
<form method="post" name="form">
<table width="100%" border="1" cellspacing="0">
	<tr>
		<td>
			Nombres
		</td>
		<td colspan="5">
			<input type="text" name="nombre" size="50" value="<?=$nombre?>">
		</td>
	</tr>
	<tr>	
		<td>
			Cedula
		</td>
		<td colspan="5">
			<input type="text" name="cedula" size="50" value="<?=$cedula?>">
		</td>
	</tr>
	<tr>	
		<td colspan="5" align="center">
			<input type="submit" name="buscar" value="Filtrar">
			<input type="submit" name="exportar" value="Exportar a Excel">
		</td>
	</tr>
	<tr>
		<td class="titulos">
			cedula
		</td>
		<td class="titulos">
			Nombre
		</td>
		<td class="titulos">
			Correo
		</td>
		<td class="titulos">
			Telefono
		</td>
		<td class="titulos">
			Codigo
		</td>
		<td class="titulos">
			E <input type="checkbox" onClick="marcar(this)">
		</td>
	</tr>
	<?
		foreach($array_users as $datos)
		{
			if($datos['idusuario'] != 1)
			{
				echo "<tr>";
				echo "<td>".$datos['cedula']."</td>";
				echo "<td>".$datos['nombre']."</td>";
				echo "<td align='center'>".$datos['correo']."</td>";
				echo "<td align='center'>".$datos['telefono']."</td>";
				echo "<td align='center'>".$datos['codigo']."</td>";
				echo "<td align='center'>
						<input type='checkbox' name='elim[]' value='".$datos['id']."'>
				      </td>";
				echo "<tr>";
			}
		}	
	?>
	<tr>
		<td colspan="5">
			
		</td>
		<td class="titulos">
			<input type="button" value="Eliminar" name="eliminar" onClick="confirmar()">
			<input type="hidden" name="accion" value="1">
		</td>
	</tr>
</table>
</form>
