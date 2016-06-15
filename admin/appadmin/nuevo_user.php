<?php
/*
 * Archivo que permite la edicion de los usuarios normales
 */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
global $db;
$funciones	=	new funciones();
//capturo el id del usuario enviado
$user	=	(isset($_GET['user']))?$_GET['user']:0;
//traigo un listado de los minisites creados
$query_sites	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE tipo_contenido=42 AND visible=1 AND eliminado=0"));

//realizo el query con la informacion del usuario
/*$query_info	=	$db->Execute(sprintf("SELECT * FROM usuarios WHERE idusuario=%s",$user));
extract($query_info->fields);*/
if(isset($_GET['edit']))
{
	if(isset($_POST['guardar']))
	{
		extract($_POST);
		//valido solo los tipo de datos
		if(empty($nombres))
		{
			echo "<script>alert('Debe escribir el nombre del usuario');</script>";
		}
		elseif(empty($apellidos))
		{
			echo "<script>alert('Debe escribir los apellidos del usuario');</script>";
		}
		elseif(empty($email))
		{
			echo "<script>alert('Debe escribir el correo electrónico');</script>";
		}
		elseif(!empty($email) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$email))
		{
			echo "<script>alert('La sintanxis del correo principal es incorrecta');</script>";
		}
		elseif(!empty($altemail) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$altemail))
		{
			echo "<script>alert('La sintanxis del correo alternativo es incorrecta');</script>";
		}
		elseif(!empty($telefono) and !is_numeric($telefono))
		{
			echo "<script>alert('El campo telefono solo debe contener Numeros');</script>";
		}
		elseif(!empty($telefonomovil) and !is_numeric($telefonomovil))
		{
			echo "<script>alert('El campo celular solo debe contener Numeros');</script>";
		}
		else
		{
			
			$resultado	=	$funciones->insertarDatos('usuarios','2','idusuario='.$user,$_POST);
			if($resultado)
			{
				echo "<script>alert('Datos guardados con exito');window.parent.closeShadow();
				location.reload();</script>";
			}
		}
	}
}
elseif(isset($_GET['new']))
{
	if(isset($_POST['guardar']))
	{
		extract($_POST);

		if(empty($nombres))
		{
			echo "<script>alert('Debe escribir el nombre del usuario');</script>";
		}
		elseif(empty($apellidos))
		{
			echo "<script>alert('Debe escribir los apellidos del usuario');</script>";
		}
		elseif(empty($email))
		{
			echo "<script>alert('Debe escribir el correo electrónico');</script>";
		}
		elseif(!empty($email) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$email))
		{
			echo "<script>alert('La sintanxis del correo principal es incorrecta');</script>";
		}
		elseif(!empty($altemail) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$altemail))
		{
			echo "<script>alert('La sintanxis del correo alternativo es incorrecta');</script>";
		}
		elseif(!empty($telefono) and !is_numeric($telefono))
		{
			echo "<script>alert('El campo telefono solo debe contener Numeros');</script>";
		}
		elseif(!empty($telefonomovil) and !is_numeric($telefonomovil))
		{
			echo "<script>alert('El campo celular solo debe contener Numeros');</script>";
		}
		else
		{
			
			$resultado	=	$funciones->insertarDatos('usuarios','1','',$_POST);
			if($resultado)
			{
				echo "<script>alert('".strip_tags($resultado)."');window.parent.closeShadow();
				location.reload();</script>";
			}
		}
	}
}
?>
<html>
	<head>
		<title>
			Edicion de usuarios
		</title>
		<style>
			body{background:#fff;font-family:Tahoma,Arial}
			#contenedor{margin:20px 20px 0 20px;width:550px;border:1px dotted #ccc}
			table{border:0}
			.cajas input{border:1px solid #ccc;width:200px}
			.btn input{border:1px solid #000;}
			.cajas1 input{border:1px solid #ccc;width:150px}
			.labels {text-transform:capitalize;font-weight:bold;text-align:left}
		</style>
		<script type="text/javascript" src="../../jscalendar/calendar.php"></script>
		<script type="text/javascript" src="../../jscalendar/lang/calendar-es.js"></script>
		<script type="text/javascript" src="../../jscalendar/calendar-setup.js"></script>
		<style type="text/css">
		    @import url("../../jscalendar/calendar-win2k-cold-1.css");
		</style>
	</head>
	<body>
	<div id="contenedor">
		<form method="post">
			<table width="100%" cellspacing="5" cellpadding="0">
				<tr>
					<td style="text-align:justify" colspan="2">
						Por favor complete el formulario para realizar la creación de un nuevo usuario en nuestra base de datos.<br>
						<span style="color:#a63b5f">Recuerde que todos los campos son obligatorios</span><br><br>
					</td>
					
				</tr>
				<tr>
					<td class="labels">
						Nombres
					</td>
					<td class="cajas">
						<input type="text" name="nombres" value="<?=$nombres ?>">
					</td>
				</tr>
				<tr>
					<td class="labels">
						Apellidos
					</td>
					<td class="cajas">
						<input type="text" name="apellidos" value="<?=$apellidos ?>">
					</td>
				</tr>
				<tr>
					<td class="labels">
						Username
					</td>
					<td class="cajas">
						<input type="text" name="username" <?if(!isset($_GET['new'])){?>readonly<?} ?> value="<?=$username ?>">
					</td>
				</tr>
				<tr>
					<td class="labels">
						genero
					</td>
					<td class="cajas">
						<select name="genero">
							<option value="M" <?if($genero=='M'){echo 'selected';} ?>>Masculino</option>
							<option value="F" <?if($genero=='F'){echo 'selected';} ?>>Femenino</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="labels">
						correo electr&oacute;nico
					</td>
					<td class="cajas">
						<input type="text" name="email" value="<?=$email ?>">
					</td>
				</tr>
				<tr>
					<td class="btn" colspan="2">
						<input type="submit" name="guardar" value="Crear Usuario">
						<input type="button" name="cerrar" value="Cerrar" onClick="window.parent.closeShadow()">
					</td>
				</tr>
			</table>
		</form>
		</div>
	</body>
</html>