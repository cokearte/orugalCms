<?
/*
 * Archivo que permite comparar los productos
 * @author Farez Jair Prieto Castro
 * @date 26 de Marzo de 2010
 * @version 1.0
*/
//incluyo los archivos que me permitiran nconectarme a la base de datos
require_once('../config/configuracion.php');
require_once('../config/conexion_2.php');
//capturo las variables que vienen por post
global $db;
$productos	=	(isset($_POST['comp']))?implode(",",$_POST['comp']):'';

function atributos($id)
{
	global $db;
	//creo el query de los tributos
	$query_atributos	=	sprintf("SELECT * FROM atributos WHERE producto=%s",$id);
	//ejecuto la consulta
	$result_atributos	=	$db->Execute($query_atributos);
	//recorro los atributos
	$atributos	=	array();
	while(!$result_atributos->EOF)
	{
		array_push($atributos,$result_atributos->fields);
		$result_atributos->MoveNext();
	}
	return $atributos;
}
if(!empty($productos))
{
	//realizo el query con los productos que vengan
	$query_comparar		=	sprintf("SELECT p.id,p.titulo,p.marca,p.imagen FROM principal AS p WHERE p.id IN(%s)",$productos);
	//ejecuto la consulta
	$result_comparar	=	$db->Execute($query_comparar);
	//arreglo resultado
	$resultados			=	array();
	//recorro el resultado
	while(!$result_comparar->EOF)
	{
		$arreglo_final	=	array("titulo"=>$result_comparar->fields['titulo'],
								  "id"=>$result_comparar->fields['id'],
								  "imagen"=>$result_comparar->fields['imagen'],
								  "atributos"=>atributos($result_comparar->fields['id']));
		array_push($resultados,$arreglo_final);
		$result_comparar->MoveNext();
	}
	echo "<html>
	<head>
		<title>
			::. VeerKamp Comparando Productos ::.
		</title>
		<style>
			table td{border:1px solid #999}
		</style>
	</head>
	<body>
		<table width='100%' cellspacing='0' align='center'>
			<tr>
				<td align='center'>
					<b>PRODUCTO</b>
				</td>
				<td align='center'>
					<b>IMAGEN</b>
				</td>";
					$cuenta		=	count($resultados[0]['atributos'][0]);
					$contador	=	0;
					foreach($resultados as $info)
					{
						if($contador != $cuenta)
						{
							foreach($info['atributos'][0] as $key=>$info)
							{
								if(!is_numeric($key))
								{
									if($key != 'producto')
									{
									echo "
									<td align='center'>
										<b>".strtoupper($key)."</b>
									</td>";
									}
								}
								$contador++;
							}
							
						}
						
					}	
			echo "</tr>";
			foreach($resultados as $llave=>$info)
			{

				echo "
				<tr>
					<td align='left'>
						<b>".ucwords($info['titulo'])."</b>
					</td>
					<td align='center'>
						<img src='Thumb.php?img=../images/".$info['imagen']."&tamano=50'>
					</td>
					";
					foreach($info['atributos'][0] as $key=>$info)
							{
								if(is_numeric($key))
								{
									if($key != 'producto')
									{
										if(!empty($info))
										{
											echo "
											<td align='center'>
												".$info."
											</td>";
										}
										else
										{
											echo "
											<td align='center'>
												N/A
											</td>";
										}
									}
								}
								//$contador++;
							}
				"
				</tr>		
				";
			}
			echo"
		</table>
	</body>
</html>";
}
else
{
	echo "ud no selecciono ningun producto <a href='#' onClick='window.close()'>Cerrar Ventana</a>";
}
?>