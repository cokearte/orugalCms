<?php
ini_set("display_errors",1);
/*
 * Se maneja la asignacion de la publicidad para las secciones de la pagina
 * @author Farez Prieto
 * @date 11 de Octubre de 2010
 */
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
extract($_GET);
$comentarios	=	$db->GetAll(sprintf("SELECT * FROM usuarios as u,principal as p, comentarios as c WHERE c.id=%s AND p.id=c.id AND c.idusuario=u.idusuario",$id));

//valido si se dio la orden de eliminar
if(isset($_GET['eliminar']))
{
	//elimino de la base de datos
	$query_borrado	=	$db->Execute(sprintf("DELETE FROM comentarios WHERE id_comentario=%s",$_GET['eliminar'])) or die(sprintf("DELETE FROM comentarios WHERE id_comentario=%s",$_GET['eliminar']));
	if($query_borrado)
	{
		echo "<script>alert('el comentario ha sido borrado con Exito');document.location='ver_comentarios.php?id=".$id."'</script>";
	}
}
?>
<html>
	<head>
		<title>
			Comenatrios del Video Seleccionado
		</title>
		<style>
			 body{background:#333333;margin:auto;padding:auto;font-size:12px;font-family:Arial}
			.titulo{text-align:center;font-weight:bold}
			td{border:1px solid #999}
        	.coment{padding:5px 0 5px 0;border-bottom:1px solid #7E7D7E;margin:0px 0 10px 0}
        	.coment h1{padding:5px 0 5px 0;margin:0px 0 10px 0;color:#fff}
        	.coment h3{color:#999;padding:0;margin:0}
        	.coment p{color:#fff;padding:0;margin:0}
        	.eliminar {color:red;text-align:right;}
        	.eliminar a{color:red;text-align:right;font-weight:bold;text-decoration:none}
        	.eliminar a:hover{color:red;text-align:right;font-weight:bold;text-decoration:underline}
		</style>
		
				<script src="../../js/flowplayer-3.2.2.min.js"></script>
	</head>
	<body>
	<div id="myDiv"  style="padding:20px 0 0 20px;width:600px">
		<div class="coment">	
			<h1>Comentarios</h1>
		</div>
		<?
			if(count($comentarios) > 0)
			{
				foreach($comentarios as $info_coment)
				{
		?>
					<div class="coment">
						<h3>Comentario publicado por: <?=$info_coment['nombres']?>  <?=$info_coment['apellidos']?></h3>
						<div> Fecha: <?=$info_coment['fecha']?></div>
						<p>
							<?=$info_coment['comentario']?>
						</p>
						<div class="eliminar">
							<a href="ver_comentarios.php?id=<?=$id ?>&eliminar=<?=$info_coment['id_comentario']?>">Eliminar</a>
						</div>
					</div>
		<?
				}
			}
			else
			{
				?>
					<div class="coment">
						<h3>Este video no tiene comentarios</h3>
					</div>
				<?
			}
		?>	
		</div>
	</body>
</html>