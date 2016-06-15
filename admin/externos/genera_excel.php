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
if(isset($_GET['export']))
{
    //debo traer todos los productos que esten en la base de datos
    $query_productos	=	sprintf("SELECT
    									p.id,
    									p.titulo,
    									p.codproducto,
    									p.marca,
    									p.resumen,
    									p.contenido,
    									p.partefabricante,
    									p.parteproducto,
    									p.keywords,
    									p.alto,
    									p.ancho,
    									p.largo,
    									p.profundidad,
    									p.puntos,
    									p.canje,
    									p.puntoscanje,
    									p.destacado,
    									p.novedad,
    									p.imagen,
    									p.imagen2,
    									p.imagen3,
    									p.imagen4,
    									p.imagen5,
    									p.promocion,
    									p.precio_normal,
    									p.precio_oferta,
    									p.iva,
    									a.*
    									FROM
    									principal as p,
    									atributos as a
    									WHERE 
    									p.id=a.producto AND
    									p.tipo_contenido=10");
   //die($query_productos);
    //ejecuto la consulta
    $result	=	$db->Execute($query_productos);
    //declaro el arreglo final
    $arreglo_final	=	array();
    //recorro el resultado
    while(!$result->EOF)
    {	
		array_push($arreglo_final,$result->fields);
		$result->MoveNext();
    }
   // var_dump($arreglo_final);
    $tabla	= "<table border='1'>";
    $contador	=	0;
     foreach($arreglo_final as $data)
    {	
    	if($contador==1)
    	{
	    	$tabla	.= "<tr>";
	    	$tabla	.= "<td>";
		    $tabla	.= "categoria";
		    $tabla	.= "</td>";
	    	$tabla	.= "<td>";
		    $tabla	.= "subcategoria";
		    $tabla	.= "</td>";
	    	$tabla	.= "<td>";
		    $tabla	.= "linea";
		    $tabla	.= "</td>";
		    $tabla	.= "<td>";
		    $tabla	.= "tiendas";
		    $tabla	.= "</td>";
			foreach($data as $llave=>$info)
			{
				if(!is_numeric($llave))
				{
					if($llave !='producto' and $llave!='id')
					{
						$tabla	.= "<td>";
						$tabla	.= "$llave";
						$tabla	.= "</td>";
					}
				}	
			}
			$tabla	.= "</tr>";
    	}
    	$contador++;
    }	
    
    foreach($arreglo_final as $data)
    {	
    	
   		$linea				=	$funciones->consultaUniversal('relacion_contenidos','id='.$data['id']);
   		$tiendas			=	$funciones->consultaUniversal('relacion_universal','id='.$data['id'].' AND tipo=5');
		if(count($linea) != 0)
		{
	   		if(!empty($linea[0]['id_padre']))
	    	{	
		    	//busco el padre de la linea actual
		    	$subcategoria		=	$funciones->consultaUniversal('principal','id='.$linea[0]['id_padre'],'id,id_padre');
		    	//busco el padre de la linea actual
		    	$categoria			=	$funciones->consultaUniversal('principal','id='.$subcategoria[0]['id_padre'],'id,id_padre');
	    	}
	    	//var_dump($subcategoria);
	    	if(!empty($subcategoria[0]['id_padre']))
	    	{
	    		//nombre de la subcategoria
	    		$subcategoria_name	=	$funciones->getNombreContenido($subcategoria[0]['id_padre']);
	    		//nombre de la subcategoria
	    		$categoria_name		=	$funciones->getNombreContenido($categoria[0]['id_padre']);
	    	}
		}
		else
		{
			$subcategoria_name	=	'';	
			$categoria_name		=	'';
		}

    	$tabla	.= "<tr>";
    	$tabla	.= "<td>";
		$tabla	.= $categoria_name;
		$tabla	.= "</td>";
    	$tabla	.= "<td>";
		$tabla	.= $subcategoria_name;
		$tabla	.= "</td>";
    	$tabla	.= "<td>";
		$tabla	.= $linea[0]['id_padre'];
		$tabla	.= "</td>";
	    $tabla	.= "<td>";
	    foreach($tiendas as $datos)
	    {
	    	$tabla	.= $datos['id_padre'].",";
	    }	
	    
	    $tabla	.= "</td>";
		foreach($data as $llave=>$info)
		{
			if(!is_numeric($llave))
			{
				if($llave !='producto' and $llave!='id')
				{
					$tabla	.= "<td>";
					$tabla	.= "$info";
					$tabla	.= "</td>";	
				}
			}	
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
			<a href="genera_excel.php?export"><img src="../images/xls.jpg" border="0"><br>Descargar Formato lista_productos.xls</a>
		</div>
	</body>
</html>