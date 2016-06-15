<?
/*
 * generador del formato en excel para cargar productos
 * @author Farez Jair Prieto Castro
 * @date  23 de Marzo de 2010
 * @version 1.0
*/
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');


global $db;
$funciones	=	new Funciones();
$listado	=	$funciones->recursivaAbajo(2,50,'id','ASC','id,id_padre,titulo,tipo_contenido');
//var_dump($listado);

if(isset($_GET['export']))
{
    $tabla	= "<table border='1'>";
  	  $tabla	.= "<tr>";
   			$tabla	.= "<td>";
   				 $tabla	.= "ID";
    		$tabla	.= "</td>";
  		  	$tabla	.= "<td>";
  		  		$tabla	.= "Titulo";
    		$tabla	.= "</td>";
   			$tabla	.= "<td>";
   				 $tabla	.= "TIPO";
   			$tabla	.= "</td>";
   	$tabla	.= "</tr>";
    foreach($listado as $data)
    {	
    	//var_dump($data);
    	$tabla	.= "<tr>";
			$tabla	.= "<td>";
				$tabla	.= $data['id'];
			$tabla	.= "</td>";
			$tabla	.= "<td>";
				$tabla	.= $data['titulo'];
			$tabla	.= "</td>";
		if($data['tipo_contenido']==2)
		{
			$tabla	.= "<td style='background:red;color:#fff'>";
				$tabla	.= "CATEGORIA";
			$tabla	.= "</td>";
		}
		elseif($data['tipo_contenido']==8)
		{
			$tabla	.= "<td style='background:#999;color:#fff'>";
				$tabla	.= "SUBCATEGORIA";
			$tabla	.= "</td>";
		}
		elseif($data['tipo_contenido']==9)
		{
			$tabla	.= "<td style='background:green;color:#fff'>";
				$tabla	.= "LINEA";
			$tabla	.= "</td>";
		}
		

		$tabla	.= "</tr>";
    }
    $tabla	.= "</table>";
    
    header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment;filename=lista_productos.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
    echo $tabla;
	die();
}
?>
<html>
	<head>
		<style>
			body{background:#fff}
			.link{padding:10px 0 0 10px;text-align:center}
		</style>
	</head>
	<body>
		<div class="link">
			<a href="genera_categorias.php?export"><img src="../images/xls.jpg" border="0"><br>Descargar listado de Categorias, Subcategorias y Lineas</a>
		</div>
	</body>
</html>