<?php
global $funciones;
global $db;
//empiezo el procedimiento del login de usuarios
//valido si han presionado el boton de login
//declaro la variable de errores
$errores	=	array();
if(isset($_POST['entrar']))
{
	//capturo las variables
	$username	=	$_POST['usuario'];
	$pass		=	$_POST['contrasena'];
	//validacion de campos vacios
	if(empty($username))
	{
		array_push($errores,'Debe ingresar su nombre de usuario');
	}
	if(empty($pass))
	{
		array_push($errores,'Debe ingresar su contrase&ntilde;a');
	}
	//si no se cometen errores
	if(count($errores) == 0)
	{
		//realizo el queri que me autenticara el usuario
		$query	=	sprintf("SELECT * FROM usuarios WHERE username='%s' AND contrasena = sha1('%s') and perfil=1",$username,$pass);
		//ejecuto la consulta
		$result	=	$db->Execute($query) or die("No se pudo realizar la consulta del usuario");
		//verifico que me retorne datos la consulta
		if($result->NumRows() > 0)
		{
			$_SESSION['login']	=	$result->fields;
			echo "<script>document.location='index.php'</script>";
		}
		else
		{
			array_push($errores,'Por for verifique sus datos');
		}
	}
	
}

include(_PLANTILLAS.'interfaz/login.html');
?>