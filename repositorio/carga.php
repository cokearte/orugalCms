<?php
session_start();
require("../config/configuracion.php");
ini_set("display_errors",0);
/*
* Repositorio de imagenes Black Image.
* @Author: Farez Prieto
* @Version: 2.0
*/
//incluyo los archivos de configuración del portal
//require_once("../configuracion/configuracion.php");
//unset($_SESSION['login']);
if(!isset($_SESSION['login']))
{
	include("rest.php");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<title>Repositorio de imagenes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
</style>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css" />
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css' />
<style>
body{background-repeat:repeat-x;background-color:#FFFFFF;font-family: 'Roboto', Helvetica, sans-serif;margin:0;padding:0;}
h1{font-size:14px;text-align:center}
a{color:#a43a0c;text-decoration:none;font-size:12px;font-weight:bold}
.cajas{padding:4px}
.boton{padding:5px;border:0}
</style>
</head>

<body>
<div class="container-fluid" style="background: #EBE9E9;border-bottom:1px solid #ccc;box-shadow: 0px 0px 3px #999">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 text-left">
				<h3>Repositorio Archivos</h3><br>
			</div>
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12" >
				<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
					<!-- Carga de imagen-->
					<form name="form1" action="upload.php" method="post" enctype="multipart/form-data" role="form">
						<div class="form-group">
							<label for="email">SUBIR UNA IMAGEN</label>
							<input class="form-control" name="archivo[]" type="file" size="35" multiple/>
							<input type="hidden" name="ruta" value="<?echo $ruta=(isset($_GET['dir']))?$_GET['dir']:'../images/';?>">
						</div>
						<div class="form-group">
							<input name="enviar" type="submit" value="Subir Imagen" class="btn btn-primary">
							<input type="button" value="Cerrar" onClick="window.close()" class="btn btn-default">
							<input name="action" type="hidden" value="upload" class="btn btn-primary">
						</div>
						<div class="form-group">
							<li style="color:#999;font-size:9.2px;display:block">Maximo 3 Mb. Formato (jpg, png, gif)</li>
							<li style="color:#333;font-size:11px;display:block;font-weight:bold">Puedes subir varias imagenes a la vez, solo manten presionada la tecla Control y selecciona las imagenes</li>
						</div>	
					</form> <br>
					</div>

				<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
					<form method="post" role="form">
						<div class="form-group">
							<label for="email">CREAR CARPETA</label>
							<input type="text" name="nombre_folder" class="form-control" size="35">
						</div>
						<div class="form-group">
							<input name="crear_folder" type="submit" value="Crear folder" class="btn btn-primary"><br>
							<li style="color:#333;font-size:11px;display:block;font-weight:bold">
								El nombre de la carpeta no debe contener (Espacios, tildes, &tilde; o cual quier caracter especial)
							</li>
						</div>	
					</form>	
				</div>
			</div>
		</div>
</div>
<div class="container-fluid" style="margin:2% 0 0 0">
	<div class="container">
		<div class="row">
			<!--centro-->
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
				<?
				if(isset($_GET['dato']))
				{
					//$form	 =	"<form name='imagen' method='post'><input type='hidden' name='nombre_foto' value='".$_GET['dato']."'>";
					//$form	.=	"La imagen seleccionada <b> ".$_GET['dato']."</b>  <input type='button' onclick='parent.mostrar('".$_POST['nombre_foto'].")' value='Adjuntar imagen' name='adjuntar'></form>";
					$form =	sprintf("<script>parent.mostrar(%s)</script>",'"'.$_GET['dato'].'"');
					echo	$form;
					
				}

				if(isset($_GET['archivo']))
				{
					$ruta	=	(isset($_GET['dir']))?$_GET['dir']:'../images/';
					unlink($ruta.$_GET['archivo']);
					echo "<script>alert('el archivo ".$_GET['archivo']." ha sido borrado con exito');window.location='carga.php?dir=".$ruta."'</script>";
					
				}
				//verifico  si se esta creando una nueva carpeta
				if(isset($_POST['crear_folder']))
				{
					//capturo el nombre de la carpeta
					$nombre_carpeta	=	$_POST['nombre_folder'];
					//capturo la ruta donde se crara la carpeta
					$ruta=(isset($_GET['dir']))?$_GET['dir']:'../images/';
					//elimino cualquier clase de caracter especial, espacion etc, del nombre de la carpeta
					$nuevo_nombre	=	str_replace('á','a',$nombre_carpeta);
					$nuevo_nombre	=	str_replace('é','e',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('í','i',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('ó','o',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('ú','u',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('$','',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('/','',$nuevo_nombre);
					$nuevo_nombre	=	str_replace(' ','_',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('à','a',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('è','e',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('ì','i',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('ò','o',$nuevo_nombre);
					$nuevo_nombre	=	str_replace('ù','u',$nuevo_nombre);
					
					if(mkdir($ruta.$nuevo_nombre, 0777))
					{
						echo "<table align='center' style='background:#F3F1F2;border:1px solid #000'>
									<tr>
										<td>
											<image src='../repositorio/ok.jpg'>
										</td>
										<td>
											<div style='color:#000'>
												La carpeta<b>".$nuevo_nombre." </b>ha sido cargada con exito
											</div>include_once 'config/configuracion.php';

										</td>
									</tr>
									<tr>
										<td align='center' colspan='2'>
											<a href='carga.php?dir=".$ruta."'>
												Volver
											</a>
										</td>
									</tr>
								</table>";
					}
					else
					{
						echo "<table align='center' style='background:#fff;border:1px solid #000'>
									<tr>							
										<td>
											<image src='../repositorio/error.png'>
										</td>
										<td>
											<div style='color:#ccc' valign='middle'>
												<img src='../repositorio/cancel.png'> Error al crear la carpeta <b>".$nuevo_nombre.". </b>
											</div>
										</td>
									</tr>
									<tr>
										<td align='center' colspan='2'>
											<a href='carga.php?dir=".$ruta."'>
												Volver
											</a>
										</td>
									</tr>
								</table>";
					}
				}
				/*
				if(isset($_POST['adjuntar']))
				{
					echo "<script>parent.mostrar('".$_POST['nombre_foto']."')</script>";
				}*/

				/*
				if(isset($_POST['adjuntar']))
				{
					echo "<script>parent.mostrar('".$_POST['nombre_foto']."')</script>";
				}*/
				?>
				<? include("imagens.php");?><br>

			</div>
		</div>
	</div>
</div>


	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var dominio  	=   "<?php echo _DOMINIO ?>";
		$(document).ready(function(){
			$(".imagenes").draggable({
			  revert: true
			});


			$(".carpetas").droppable({
			  drop: function(event,ui){
			  	var origen  = ui.draggable.data("ruta");
			  	var imagen  = ui.draggable.data("imagen");
			  	var destino = $(this).data('carpeta');
         
			  	$.ajax({
				    url: dominio+"php/mueveFoto.php",
				    data: "accion=1&origen="+origen+"&destino="+destino+"&imagen="+imagen,
				    type: "GET",
				    dataType: "jsonp",
				    success:function(json)
				    {
				    	ui.draggable.remove();
				    	//alert(json.mensaje);
				    	location.reload();
				    },
				    error:function(e){
				        //$("#ERRORES").html(e.statusText + e.status + e.responseText);
				    }
				});

			  	/*alert(origen + "  -  "+destino);
			  	location.reload();*/
			  	//realizo el movimiento de la foto via ajax

			  }
			});
		});


	</script>
</body>
</html>
<?php }?>
