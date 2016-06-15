<?php
/*
 * Archivo que controlara el envio de los boletines
 */
ini_set("display_errors",0);
require("../core/phpmailer/class.phpmailer.php");
global $id;
global $db;
global $funciones;
$filtro		 =	'';
$nombre		 =	'';
$listado_usuarios	=	$db->Execute(sprintf("SELECT * FROM boletin WHERE id_boletin != '' %s",$filtro)) or die(sprintf("SELECT * FROM boletin WHERE id_boletin != '' %s",$filtro));
//arreglo donde se mostraran los usuarios
$usuarios			=	array();
//recorro
while(!$listado_usuarios->EOF)
{
	array_push($usuarios,$listado_usuarios->fields);
	$listado_usuarios->MoveNext();
}
//meto en un arreglo los boletines que hay para mostrarlos en los listados
$boletines	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE tipo_contenido=46 AND visible=1 AND eliminado=0"));
//var_dump($query_boletines);
//var_dump($query_boletines);
//debo traer el listado de usuarios que esten en la base de datos
//aca debo saber si los filtros vienen
//1 . VALIDO SI HICIERON CLICK EN EL BOTON ENVIAR
if(isset($_POST['enviar']))
{
	extract($_POST);
	foreach($users as $vuelta)
	{
		//lo primero que debo hacer es consultar los usuarios del boletin
		$query_usuarios		=	$db->Execute(sprintf("SELECT * FROM boletin WHERE id_boletin=%s",$vuelta));
		//consulto la informacion del boletin que se selecciona
		$info_boletin_envio	=	$funciones->infoId($boletin);
		//ahora recorro el resultado para empezar a enviar el correo
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$asunto		= 'Boletin Electronico';
		//armo el correo
		while(!$query_usuarios->EOF)
		{
			$mensaje	=	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
									<html xmlns="http://www.w3.org/1999/xhtml">
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<title>BULEVAR NIZA</title>
									</head>
									
									<body>
									<table width="585" border="0" cellpadding="0" cellspacing="0">
									  <tr>
									    <td  bgcolor="#000000" style="padding:0 20px 0 20px;">
									    <table width="585" border="0" cellpadding="0" cellspacing="0">
									      <tr>
									        <td colspan="2"><img src="'._DOMINIO.'images/diseno/cabezote.jpg" width="600" height="124" /></td>
									      </tr>
									      <tr>
									        <td width="259"  valign="top" bgcolor="#000">
									        	<img style="margin:10px 10px 10px 40px;" src="'._DOMINIO.'/images/'.$info_boletin_envio[0]['imagen'].'" width="202" height="132" /></td>
									        <td width="341"  bgcolor="#000" style="padding:0 20px 10px 20px;color:#fff">
									        	<h1 style="font-size:14px; color:#666; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">
									        		'.utf8_decode($info_boletin_envio[0]['titulo']).'
									        	</h1>
									        	<p style=" text-align:justify;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#fff;">
									        		'.utf8_decode($info_boletin_envio[0]['contenido']).'
												</p>
											</td>
									      </tr>
									      <tr>
									        <td colspan="2"><img src="'._DOMINIO.'images/diseno/pie.jpg" width="600" height="88" /></td>
									      </tr>
									    </table></td>
									  </tr>
									</table>
									</body>
									</html>';
				$para	=	$query_usuarios->fields['mail'];
				//procedo a hacer el envio del mail
				
				if($funciones->SendMAIL($para,$asunto,$mensaje,"Boletin Electronico",'contacto@bulevar.co',"CC Bulevar Niza") == 1)
				{
					echo "Se envio el correo a : ".$query_usuarios->fields['mail']."<br>";
				}
				else
				{
					echo "No Se envio el correo a : ".$query_usuarios->fields['mail']."<br>";
				}
				$query_usuarios->MoveNext();
		}
	}
}
?>
<!-- Armo el form del envio -->
<link rel="stylesheet" type="text/css" href="../shadowbox-3.0.3/shadowbox.css">
<script type="text/javascript" src="../shadowbox-3.0.3/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({
    handleOversize: "drag",
    modal: true
});
</script>
<style>
	.titulo_bol{font-weight:bold;text-align:center;border:1px solid #ccc}
	.interno{border:1px solid #ccc}
</style>
<script>
function marcar(obj)
{
  for (i=0; ele = obj.form.elements[i]; i++)
	if (ele.type=='checkbox')
	  ele.checked = obj.checked;
}
function previewBoletin(idboletin,idcelda)
{
	document.getElementById('link'+idcelda).innerHTML="<a href='boletin/boletin.php?boletin="+idboletin+"' rel='Shadowbox; width=845px'>Visualizar</a>";
}
function validaEliminar()
{
	if(confirm('¿Esta seguro que desea eliminar este usuario?') == true)
	{
		document.usuarios.submit();
	}
	else
	{
		return true;
	}
}
function generarClave(id_user,tipo,id)
{
	if(confirm("Se va a generar una clave para este usuario, Desea continuar?")==true)
	{
		document.location="index.php?id="+id+"&genera="+id_user+"&tipo="+tipo;
	}
	else
	{
		return false;
	}
}
function closeShadow()
{
   Shadowbox.close();
   //window.location	=	'index.php?id='+id;
}
</script>
<form name="form" method="post" name='usuarios'>
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" class="titulo_bol">
			BOLETIN
		</td>
		<td align="center" class="titulo_bol">
			SELECIONE
		</td>
	</tr>
	<?
	foreach($boletines as $data)
	{
		echo "
				<tr>
					<td class='interno'>".$data['titulo']."</td>";
					echo "</td>
					<td class='interno' align='center'><input type='radio' name='boletin' value='".$data['id']."'></td>
				</tr>
			";	
	}
	?>
	<tr>
		<td colspan="3" align="right"><input type="submit" value="Enviar Boletin" name="enviar"></td>
	</tr>
</table>
<style>
	.titulos{border:1px solid #999;font-weight:bold;text-align:center}
	.celdas{border:1px solid #999;}
</style>
<br><br>
<!-- 
<table width="100%">
	<tr>
		<td>
			Nombre Usuario
		</td>
		<td>
			<input type="text" name="nombre" value="<?=$nombre?>">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="filtrar" value="Filtrar">
			<input type="submit" name="export" value="Exportar a Excel">
		</td>
	</tr>
</table>-->
<?
/*En esta parte se mostraran los usuarios registrados en forma de lista*/
echo "
		<table width='100%' cellspacing='0' cellpadding='0'>
			<tr>
				<td align='center' class='titulos' colspan='4'>
					USUARIOS
				</td>
			</tr>
			<tr>
				<td align='center' class='titulos'>
					NOMBRES
				</td>
				<td align='center' class='titulos'>
					CELULAR
				</td>
				<td align='center' class='titulos'>
					MAIL
				</td>
				<td align='center' class='titulos'>
					<input type='checkbox' onClick='marcar(this)'>
				</td>
			</tr>
			";
			//hora armo el listado
			foreach($usuarios as $datos_user)
			{
				echo "<tr>
							<td align='center'  class='celdas'>
								".$datos_user['nombre']."
							</td>
							<td align='center' class='celdas'>
								".$datos_user['celular']."
							</td>
							<td align='center' class='celdas'>
							".$datos_user['mail']."
											</td>
							<td align='center' class='celdas'>
								<input type='checkbox' name='users[]' value='".$datos_user['id_boletin']."'>
							</td>
						</tr>";
			}
		/*echo "<tr>
				<td colspan='4' align='right'>
					<input type='button' name='eliminar' value='Eliminar' onClick='validaEliminar()'>
				</td>
			 </tr>";*/
		echo"</table></form>";

function colorTipo($tipo,$arreglo_tipo)
{
	foreach($arreglo_tipo as $colores)
	{
		if($colores['id'] == $tipo)
		{
			$cuadro	=	"<div style='text-align:center;background:".$colores['color'].";font-weight:bold;color:#fff'>".$colores['titulo']."</div>";
		}
	}
	return $cuadro;
}
?>