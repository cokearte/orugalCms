<?php

global $funciones;
global $core;
global $id;
global $migas;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
$ministerios	=	$funciones->obtenerListado(14);

//listado de paises
$paises		=	$db->GetAll(sprintf("SELECT * FROM paises"));
//valudo si sedio la orden de enviar el contacto
$errores	=	"";
require('core/phpmailer/class.phpmailer.php');
if(isset($_POST['enviar']))
{
	extract($_POST);
	//valido llos campos necesarios o requeridos
	if(empty($nombres))
	{
		//echo "<script>alert('El nombre es un campo requerido')</script>";
		$errores	=	"El nombre es un campo requerido";
	}
	elseif(!empty($telefono) and strlen($telefono) < 7)
	{
		//echo "<script>alert('El telefono solo puede tener Numeros')</script>";
		$errores	=	"Por favor escriba un número de telefono valido";
	}
	elseif(!empty($telefono) and !is_numeric($telefono))
	{
		//echo "<script>alert('El telefono solo puede tener Numeros')</script>";
		$errores	=	"El telefono solo puede tener Numeros";
	}
	elseif(empty($mail))
	{
		//echo "<script>alert('Debe escribir su correo electronico')</script>";
		$errores	=	"Debe escribir su correo electronico";
	}
	elseif(!empty($mail) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$mail))
	{
		//echo "<script>alert('La sintaxis de su correo no es correcta por favor verifique. EJ: correo@dominio.com / com.co')</script>";
		$errores	=	"El correo electrónico es incorrecto, por favor verifique. EJ: correo@dominio.com / com.co";
	}
	elseif(empty($comentario))
	{
		//echo "<script>alert('Por favor escriba su comentario')</script>";
		$errores 	=	"Por favor escriba su comentario";
	}
	elseif (empty($seguridad))
	{
		$errores 	=	"Por favor escriba el código de seguridad";
	}
	elseif ($seguridad != $_SESSION['key']) 
	{
		$errores 	=	"El código de seguridad no coincide, por favor verifique";
	}
	else
	{
		$asunto			 =	'Se ha enviado un mensaje atravez de la pagina web '._NOMBRE_EMPRESA;
		$mensaje_armado	 =	'Se ha enviado un mensaje atravez de la pagina web '._NOMBRE_EMPRESA.':<br><br><br>';
		$mensaje_armado	.= '<b>Nombres y apellidos:</b> '.$nombres.' '.$apellidos.'<br>';
		$mensaje_armado	.= '<b>Correo Electronico:</b> '.$mail.'<br>';
		$mensaje_armado	.= '<b>Telefono: </b>'.$telefono.'<br>';
		$mensaje_armado	.= '<b>Comentario:</b> '.$comentario.'<br>';
		$envio			 =	$funciones->SendMAIL(_MAIL_ADMIN,$asunto,$mensaje_armado,'',$mail,_NOMBRE_EMPRESA);
		//inserto datos en la base de datos
		//$final				=	$funciones->insertarDatos('mensajes',1);
		//die($final);
		if($envio == 1)
		{
			echo "<script>alert('La informacion ha sido enviada con exito.');document.location='home'</script>";
		}
		else
		{
			echo "<script>alert('La informacion no puso ser enviada');document.location='home'</script>";
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
						Gracias por Visitarnos, por favor complete el formulario y nosotros lo llamaremos sin costo alguno.
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
						<label>Nombre
							<input type="text" name="nombres" value="<?php echo $nombres ?>" placeholder="Escribe tu nombre" class="cajasContacto" />		
						</label>
					</div>
					<div class="infoInternaContContacto">
						<div class="panel50">
							<label>Teléfono
								<input type="text" name="telefono" value="<?php echo $telefono ?>" placeholder="Escribe tu Telefono Fijo" class="cajasContacto" />		
							</label>
						</div>
						<div class="panel50">
							<label>Mail
								<input type="text" name="mail" value="<?php echo $mail ?>" placeholder="Escribe Número Celular" class="cajasContacto" />		
							</label>
						</div>
					</div>
					<div class="infoInternaContContacto">
						<label>Mensaje
							<textarea name="comentario"  placeholder="Dejanos tu mensaje" class="textAreaContacto"><?php echo $comentario ?></textarea>		
						</label>
					</div>	
					<div class="infoInternaContContacto">
						<label>Código de Seguridad<br>
							<img src="<?php echo _DOMINIO ?>php/captcha/captcha.php" width="200px"/>
						</label>
					</div>
					<div class="infoInternaContContacto">
						<label>Escribe el código de seguridad
							<input type="text" name="seguridad" placeholder="Escribe las letras que aparecen arriba." class="cajasContacto" />		
						</label>
					</div>
					<div class="infoInternaContContacto">
						<input type="submit" value="Enviar" name="enviar" class="btnEnviarContacto"/>
					</div>
				</form>
			</div>
			<div class="contDataEmpresa">
				<img src="<?php echo _DOMINIO ?>/images/diseno/imgContacto.png"><br><br>
				<!--Cel: 311 098 098<br>-->
				<strong>Tel:  616 2066 ext 108</strong><br>
				info@asograsas.com
			</div>
		</div>
	</div>
</div>