<?php
session_start();
require("../config/configuracion.php");
require("../config/conexion_2.php");
global $db;
$dir	=	(isset($_GET['dir']))?$_GET['dir']:'1';
ini_set("display_errors",0);
/*
* Repositorio de imagenes Black Image.
* @Author: Farez Prieto
* @Version: 2.0
*/
//incluyo los archivos de configuración del portal
//require_once("../configuracion/configuracion.php");
//unset($_SESSION['login']);

//traigo las carpetas iniciales
$infoFolderActual	=	$db->GetAll(sprintf("SELECT * FROM repositorioimagenes WHERE idFile=%s AND eliminado=0",$dir));
$migaCarpetas 		=	BusquedaRecursiva($dir,array());

$rutavisitada		= "";
foreach($migaCarpetas as $miga)
{
	$rutavisitada		.= $miga['nombre']."/";
}
//var_dump($migaCarpetas);


function BusquedaRecursiva($id,$datos)
{
	global $db;
	$resultado	=	$db->GetAll(sprintf("SELECT * FROM repositorioimagenes WHERE idFile=%s AND eliminado=0",$id));
	//echo sprintf("SELECT * FROM repositorioimagenes WHERE idFile=%s AND eliminado=0",$id)."<br>";
	if($resultado[0]['idpadre'] != "0")
    {
		//var_dump($resultado);
            //si lo es pondre los datos traidos en el arreglo
            array_push($datos,$resultado[0]);
            //y de nuevo llamo la funcion
            return BusquedaRecursiva($resultado[0]['idpadre'],$datos);

    }
    //cuando ya el padre sea igual a 0 es por que ya llego a la pagina de inicio
    else
    {
		//var_dump($resultado);
        //si lo es pondre los datos traidos en el arreglo
        array_push($datos,$resultado[0]);
        //retorno el arreglo
        return(array_reverse($datos));
    }
    //return $datos;
}

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
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<!--<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css" />-->
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css' />
	<style>
		body{background-repeat:repeat-x;background-color:#FFFFFF;font-family: 'Roboto', Helvetica, sans-serif;margin:0;padding:0;}
		h1{font-size:14px;text-align:center}
		a{color:#337AB7;text-decoration:none;}
		.cajas{padding:4px}
		.boton{padding:5px;border:0}
		.barra{box-shadow:none;border:none;border-radius: 0}
	</style>
</head>
<body>

		<nav class="navbar navbar-inverse" style="border-radius:0">
		  <div class="container-fluid">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php"><?php echo _NOMBRE_EMPRESA ?> - Repositorio</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <?php include("includes/lateral.php");?>
		      </ul>
		      <ul class="nav navbar-nav navbar-right" style="margin:1% 0 0 0">
		        	<a href="index.php?logout" class="btn btn-primary">Cerrar</a>
		      </ul> 

		    </div><!-- /.navbar-collapse -->

		  </div><!-- /.container-fluid -->
		  </div><!-- /.container-fluid -->
		</nav>
<div class="container-fluid">
	<div class="container">

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
					$ruta	=	$_GET['dire'];
					//unlink($ruta.$_GET['archivo']);
					$queryUpdate = $db->Execute(sprintf("UPDATE repositorioimagenes SET eliminado=1 WHERE idFile=%s",$_GET['idFile']));

					echo '<div class="alert alert-success">
								  <strong>Proceso exitoso!.</strong> El archivo <b>'.$_GET['archivo'].'</b> ha sido eliminado con &eacute;xito. <a href="carga.php?dir='.$dir.'">
												Cerrar
											</a>
							 </div>';

					//echo "<script>alert('el archivo ".$_GET['archivo']." ha sido borrado con exito');window.location='carga.php?dir=".$ruta."'</script>";
					
				}
				//verifico  si se esta creando una nueva carpeta
				if(isset($_POST['crear_folder']))
				{
					//capturo el nombre de la carpeta
					$nombre_carpeta	=	$_POST['nombre_folder'];
					//capturo la ruta donde se crara la carpeta
					$ruta = "../".$rutavisitada;
					//elimino cualquier clase de caracter especial, espacion etc, del nombre de la carpeta
					$nuevo_nombre	=	str_replace('á','a',strtolower($nombre_carpeta));
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
						$queryInsert = $db->Execute(sprintf("INSERT INTO repositorioimagenes (idpadre,nombre,tipo) VALUES('%s','%s','%s')",$_POST['padre'],$nuevo_nombre,1));
						echo '<div class="alert alert-success">
								  <strong>Proceso exitoso!.</strong> La carpeta <b>'.$nuevo_nombre.'</b> ha sido creada con &eacute;xito. <a href="carga.php?dir='.$_POST['padre'].'">
												Cerrar
											</a>
							 </div>';
					}
					else
					{
						echo '<div class="alert alert-danger">
								  <strong>Proceso fallido!.</strong> La carpeta <b>'.$nuevo_nombre.'</b> no pudo ser creada, por favor intente de nuevo m&aacute;s tarde. <a href="carga.php?dir='.$_POST['padre'].'">
												Cerrar
											</a>
							 </div>';
					}
				}
				?>





		<ol class="breadcrumb">
		  <?php foreach($migaCarpetas as $miga){?>
		  	<?php if($miga['idFile'] != $dir){?>	
		  		<li><a href="?dir=<?php echo $miga['idFile']?>"><?php echo $miga['nombre']?></a></li>
		  	<?php }else{?>
		  		<li class="active"> <?php echo $miga['nombre']?></li>
		  	<?php }?>
		  <?php }?>
		</ol>
	</div>
</div>	
<div class="container-fluid">
	<div class="container">
		<ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">Archivos actuales</a></li>
		    <li><a data-toggle="tab" href="#subir">Subir nuevos archivos</a></li>
		  </ul>

		  <div class="tab-content" style="border-left:1px solid #DDDDDD;border-bottom:1px solid #DDDDDD;border-right:1px solid #DDDDDD">
		    <div id="home" class="tab-pane fade in active">
				<? include("imagens.php");?><br>
		    </div>
		    <div id="subir" class="tab-pane fade">
		      <div class="container-fluid" style="border-bottom:1px solid #ccc;">
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
										<input  name="archivo[]" type="file" size="35" multiple/>
										<input type="hidden" name="ruta" value="../<?php echo $rutavisitada;?>">
										<input type="hidden" name="padre" value="<?php echo $dir?>">
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
										<input type="hidden" name="padre" value="<?php echo $dir?>" class="form-control" size="35">
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
