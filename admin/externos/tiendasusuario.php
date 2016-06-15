<?php
//archivo de guardado de la calificacion
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../config/configuracion.php');
require_once('../config/conexion_2.php');

$prod				=	$_GET['prod'];

$tabla				=	'principal as p,relacion_universal as r';
$condicion_query	=	sprintf('WHERE r.id=%s AND r.id_padre=p.id AND r.tipo=5',$prod);
//calculo  el puntaje
$query_puntaje		=	sprintf("SELECT * FROM %s %s",$tabla,$condicion_query);
$resultado_puntaje	=	$db->Execute($query_puntaje);
//si me trajo datos
$info				=	array();
//recorro el resultado para ponerlo en un arreglo
while(!$resultado_puntaje->EOF)
{
	array_push($info,$resultado_puntaje->fields);
	$resultado_puntaje->MoveNext();
}
?>
<html>
	<head>
		<title>Tiendas en las que se encuentra este producto</title>
		<style>
			body{background:#fff}
		</style>
	</head>
	<body>
		<table>
		<?
		if(count($info) > 0)
		{
			foreach($info as $datos)
			{
				echo'
				<tr>
					<td>
						<img src="../images/'.$datos['imagen'].'" width="200px">
					</td>
					<td>
						<a href="'._RUTA_WEB.'index.php?id=12&del" target="_parent">'.$datos['titulo'].'</a>
						<p>'.$datos['notas'].'</p>
					</td>
				</tr>';	
			}
		}
		else
		{
			echo "No hay tiendas con este producto en stock";
		}
		 ?>
		 </table>
	</body>
</html>