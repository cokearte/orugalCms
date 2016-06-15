<?php
require("archivos.class.php");
global $funciones;
global $core;
global $id;
global $migas;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;


$errores	=	"";
require('core/phpmailer/class.phpmailer.php');
if(isset($_POST['enviar']))
{
	extract($_POST);
	//valido llos campos necesarios o requeridos
	if(empty($usuario))
	{
		//echo "<script>alert('El nombre es un campo requerido')</script>";
		$errores	=	"Debe escribir su nombre de usuario para poder ingresar";
	}
	elseif(empty($clave))
	{
		//echo "<script>alert('El nombre es un campo requerido')</script>";
		$errores	=	"Debe escribir su contraseña para poder ingresar";
	}
	else
	{
		//si los campos estan completos ebo verificar que el usuario exista en la base de datos
		$objFiles	=	new archivos();
		$verificaUsuario	=	$objFiles->verificaSession($usuario,$clave);

		//valido si esto me trae reultados
		if(count($verificaUsuario) > 0)
		{
			//si esto me retornó resultados levanto la session
			$_SESSION['afiliado']	=	$verificaUsuario[0];
			echo "<script>document.location='"._DOMINIO."afiliados'</script>";
		}
		else
		{
			$errores	=	"El usuario Ingresado no existe en la base de datos";
		}
	}
}
?>
<div class="contenedores">
	<div class="centros">
		<div class="centrosInt">
			<div class="contDataUsuario">
				<form method="post">
					<div class="subContContacto">
						Bienvenido a la zona de Afiliados de <strong>Asograsas</strong>, por favor usa tu usuario y clave para acceder a la información.
					</div>
					<div class="infoInternaContContacto">
						<span class="obligatorio">Todos los campos son obligatorios</span>
					</div>
					<?php if($errores != ""){ ?>	
						<div class="infoInternaContContacto">
							<span class="errorContacto"><?php echo $errores ?></span>
						</div>
					<?php } ?>
					<div class="infoInternaContContacto">
						<label>Usuario
							<input type="text" name="usuario" value="<?php echo $usuario ?>" placeholder="Escribe tu nombre" class="cajasContacto" />		
						</label>
					</div>
					<div class="infoInternaContContacto">
						<label>Contraseña
							<input type="password" name="clave" value="<?php echo $clave ?>" placeholder="Escribe tu nombre" class="cajasContacto" />		
						</label>
					</div>
					
					<div class="infoInternaContContacto">
						<input type="submit" value="Enviar" name="enviar" class="btnEnviarContacto"/>
					</div>
				</form>
			</div>
			<div class="contDataEmpresa"><br><br><br>
				<img src="<?php echo _DOMINIO ?>/images/diseno/logo.png"><br><br>
				<!--Cel: 311 098 098<br>-->
				<strong>Tel:  616 2066 ext 108</strong><br>
				info@asograsas.com
			</div>
		</div>
	</div>
</div>