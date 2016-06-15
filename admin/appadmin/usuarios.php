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
$accion		=	(isset($_GET['accion']))?base64_decode($_GET['accion']):1;
$filtro		= '';
function nombreSitio($idSitio)
{
	global $funciones;
	$datos_sitio	=	$funciones->infoId($idSitio);
	return $datos_sitio; 
}
if($accion == 1)//listo usuarios del aplicativos
{
	
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
			$filtro	.=	" nombres LIKE '".$_POST['nombre']."'";
		}
	 	if(!empty($_POST['apellido']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" apellidos LIKE '".$_POST['apellido']."'";
		}
	 	if(!empty($_POST['genero']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" genero LIKE '".$_POST['genero']."'";
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
			$filtro	.=	" nombres LIKE '".$_POST['nombre']."'";
		}
	 	if(!empty($_POST['apellido']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" apellidos LIKE '".$_POST['apellido']."'";
		}
	 	if(!empty($_POST['genero']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" genero LIKE '".$_POST['genero']."'";
		}
		//$query_exportar	=	$db->GetAll(sprintf("SELECT * FROM usuarios WHERE  %s ORDER BY nombres ASC",$filtro));
		echo "<script>alert('Se exportara el excel');document.location='externos/exporta_usuarios1.php?filtro=".base64_encode($filtro)."'</script>";
		
	 }
	 else
	 {
		 //valido si se dio la orden de eliminar
		if(isset($_POST['accion']))
		{
			//realizo el query de borrado
			$query_borrado	=	$db->Execute(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode($_POST['elim'])));
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
	 	 $array_users	=	$db->GetAll(sprintf("SELECT * FROM usuarios WHERE  %s AND perfil=2",$filtro)) or die(sprintf("SELECT * FROM usuarios WHERE  %s",$filtro));
	 }
	 else
	 {
	 	//die("aca");
		 $array_users	=	$db->GetAll(sprintf("SELECT * FROM usuarios WHERE perfil=2"));// or die(sprintf("SELECT * FROM usuarios WHERE perfil=2"));
		// echo sprintf("SELECT * FROM usuarios");
	 }
	 ///var_dump($array_users);
	 //asigno la plantilla que debe mostrar para esta parte del form
	 include("html/usuario_normales.html");
}
elseif($accion == 2)//usuarios de la bolsa de empleo
{
	 //valido si se dio la orden de filtrar
	 if(isset($_POST['buscar']))//filtrar los usuarios
	 {
	 	extract($_POST);
	 	$filtro	=	" u.idusuario=c1.idusuario ";
		if(!empty($_POST['nombre']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" c1.nombres LIKE '%".$_POST['nombre']."%'";
		}
	 	if(!empty($_POST['apellido']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" c1.primer_apellido LIKE '%".$_POST['apellido']."%'";
		}
	 	if(!empty($_POST['genero']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" c1.sexo LIKE '".$_POST['genero']."'";
		}
	 }
	 elseif(isset($_POST['exportar']))//exportar los usuarios
	 {
	 	extract($_POST);
	 	$filtro	=	"u.idusuario=c1.idusuario";
		if(!empty($_POST['nombre']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	"c1. nombres LIKE '%".$_POST['nombre']."%'";
		}
	 	if(!empty($_POST['apellido']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" c1.primer_apellido LIKE '%".$_POST['apellido']."%'";
		}
	 	if(!empty($_POST['genero']))
		{
			if(!empty($filtro))
			{
				$filtro	.=	"AND";	
			}
			$filtro	.=	" c1.sexo LIKE '".$_POST['genero']."'";
		}
		//$query_exportar	=	$db->GetAll(sprintf("SELECT * FROM usuarios WHERE  %s ORDER BY nombres ASC",$filtro));
		echo "<script>alert('Se exportara el excel');document.location='externos/exporta_usuarios1.php?filtro=".base64_encode($filtro)."'</script>";
		
	 }
	 else
	 {
		//valido si se dio la orden de eliminar
		if(isset($_POST['accion']))
		{
			//realizo el query de borrado
			$query_borrado1	=	$db->Execute(sprintf("DELETE FROM curriculum1 WHERE idusuario in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode($_POST['elim'])));
			$query_borrado2	=	$db->Execute(sprintf("DELETE FROM curriculum2 WHERE idusuario in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode($_POST['elim'])));
			$query_borrado3	=	$db->Execute(sprintf("DELETE FROM curriculum3 WHERE idusuario in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode($_POST['elim'])));
			$query_borrado4	=	$db->Execute(sprintf("DELETE FROM curriculum4 WHERE idusuario in(%s)",implode(',',$_POST['elim']))) or die(sprintf("DELETE FROM usuarios WHERE idusuario in(%s)",implode($_POST['elim'])));
			if($query_borrado4)
			{
				echo "<script>alert('Los usuarios seleccionados se han borrado con exito');document.location='index.php?id=".$id."&accion=".$_GET['accion']."'</script>";
			}
			else
			{
				echo "<script>alert('Los usuarios seleccionados no se han borrado');</script>";
			}
		}
	 }
	 if(empty($filtro))
	 {
		$query_usuarios	=	$db->Execute(sprintf("SELECT * FROM usuarios as u,curriculum1 as c1 WHERE u.idusuario=c1.idusuario")) or die('paila');
	 }
	 else
	 {
	 	//echo sprintf("SELECT * FROM usuarios as u,curriculum1 as c1 WHERE %s",$filtro);
	 	$query_usuarios	=	$db->Execute(sprintf("SELECT * FROM usuarios as u,curriculum1 as c1 WHERE %s",$filtro)) or die('paila');
	 }
	
	 $array_users		=	array();
	 //recorro y armo el listado de estos usuarios
	 while(!$query_usuarios->EOF)
	 {
	 	array_push($array_users,$query_usuarios->fields);
	 	$query_usuarios->MoveNext();
	 }
	 //asigno la plantilla que debe mostrar para esta parte del form
	 include("html/usuario_bolsa.html");
}
else//muestra mensaje de error
{
	if(isset($_GET['genera']))
	{
		$id_user	=	$_GET['genera'];
		//procedo a generar la clave
		//genero la nueva contraseña
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		//$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ$@+$abcdefghijklmnopqrstuvwxyz1234567890';
		$cad = "";
		for($i=0;$i<8;$i++) {
			$cad .= substr($str,rand(0,25),1);
		}
		
		//ahora procedo a consultar el correo del usuario para enviarle
		$query_datos_user	=	$db->Execute(sprintf("SELECT * FROM usuarios WHERE idusuario=%s",$id_user)) or die(sprintf("SELECT email FROM usuarios WHERE idusuario=%s",$id_user));
		//inserto la contraseña en la base de datos para el usuario seleccionado
		//die(sprintf("UPDATE usuarios SET contrasena=sha1('%s') WHERE idusuario=%s",$cad,$id_user));
		$query_insert_clave	=	$db->Execute(sprintf("UPDATE usuarios SET contrasena=sha1('%s') WHERE idusuario=%s",$cad,$id_user)) or die(sprintf("UPDATE usuarios SET contrasena=sha1('%s') WHERE idusuario=%s",$cad,$id_user));
		//si la actualizacion del dato se llevo a cabo procedo a enviarle el mail al usuario
		if($query_insert_clave)
		{
			//procedo a enviar el mail
			$asunto				 =	"Asignación de Contraseña "._NOMBRE_EMPRESA;
			$mensaje			 =	"Se le ha asignado una contraseña para el acceso a la información de afiliados.<br><br>";
			$mensaje			.=	"Los datos de acceso son los siguientes<br><br>";
			$mensaje			.=	"Usuario: ".$query_datos_user->fields['username']."<br>";
			$mensaje			.=	"Contraseña: ".$cad."<br><br>";
			$mensaje			.=	"Para Acceder a la información debe hacerlo en la siguiente url: <a href='"._DOMINIO."/afiliados'>click aquí</a><br><br>";
			$para				 =	$query_datos_user->fields['email'];
			if($funciones->SendMAIL($para,$asunto,$mensaje,"Asignación de Contraseña",_MAIL_ADMIN,_NOMBRE_EMPRESA) == 1)
			{
				//echo "aca";
				echo "<script>alert('Se envio la contrase\u00f1a al correo : ".$query_datos_user->fields['email']."');document.location='index.php?id=".$id."&accion=".base64_encode(1)."'</script>";
			}
			else
			{
				echo "<script>alert('No se pudo enviar la contraseña al correo : ".$query_datos_user->fields['email'].". Intente de nuevo más tarde');document.location='index.php?id=".$id."&accion=".base64_encode(1)."'</script>";
				//echo "no aca";
				//echo "No Se envio la contrase\u00f1a al  correo : ".$query_datos_user->fields['mail']."<br>";
			}
		}
		else
		{
			echo "No pudo ser Actualizada la contrase\u00f1a";
		}
	}
	else
	{
		echo '<ul>
			<li><a href="index.php?id='.$id.'&accion='.base64_encode('1').'">Usuarios de la Tienda</a></li>
			<li><a href="index.php?id='.$id.'&accion='.base64_encode('2').'">Usuarios Bolsa de empleo</a></li>
		</ul>';
	}	
}
?>
