<?
/*
 * Cargue automatico de productos para el catalogo de Veerkamp.
 * @author Farez Jair Prieto Castro
 * @date  23 de Marzo de 2010
 * @version 1.0
*/
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
/*
 * empiezo el proceso de carga del archivo csv que inicialmente debe guardarse como archivo temporal en un folder llamado temp/ alli se guadrara ese archivo
 * y despues el sistema empezara a hacer la lectura de la informacion para la creacion de los productos de forma dinamica.
 * luego de haber insertado los productos el sistema se encargara de borrar el archivo temporal.
 */
//objeto de la clase funciones
$funciones		=	new Funciones();
//Declaracion de variables
$separador		=	";";
//id_padre default
$id_padre		=	"0";
//tipo contenido
$tipo_contenido	=	10;
//valido si se ha presionado el boton cargar.
if(isset($_POST['cargar']))
{
	//Primero procedo a guardar el archivo en el servidor
	//obtenemos los datos del archivo 
    $tamano 	= $_FILES["archivo"]['size'];// tamaño
    $tipo 		= $_FILES["archivo"]['type'];//tipo
    $archivo	= $_FILES["archivo"]['name'];//nombre 
	//Primero valido si el archivo que se esta cargando es un .CSV
	if($tipo == 'application/vnd.ms-excel')
	{    
	    //reemplazo caracteres especiales en el nombre del archivo para reducir errores por culpa del nombre del archivo
	    $prefijo	=	str_replace(' ','_',$archivo);
		$prefijo	=	str_replace('á','a',$prefijo);
		$prefijo	=	str_replace('é','e',$prefijo);
		$prefijo	=	str_replace('í','i',$prefijo);
		$prefijo	=	str_replace('ó','o',$prefijo);
		$prefijo	=	str_replace('ú','u',$prefijo);
		$prefijo	=	str_replace('Á','a',$prefijo);
		$prefijo	=	str_replace('É','e',$prefijo);
		$prefijo	=	str_replace('Í','i',$prefijo);
		$prefijo	=	str_replace('Ó','o',$prefijo);
		$prefijo	=	str_replace('Ú','u',$prefijo);
		$prefijo	=	str_replace('ñ','n',$prefijo);
		$prefijo	=	str_replace('Ñ','n',$prefijo);
		//declaro el folder donde se guardara el archivo temporal
		$destino =  "temp/";
		//Ahora debo estar seguro que el folder temporal exista, si no es asi debo crearlo.
		if(!is_dir($destino))
		{
			//creo el folder con todos los permisos
			mkdir($destino,0777,true);
		}
		//Procedo a subir el archivo a la carpeta temporal
		if(copy($_FILES['archivo']['tmp_name'],$destino.$archivo))
		{
			//asigno el mensaje de que el archivo se subio bien
			$mensaje	=	"<li>Archivo <b>".$archivo."</b> Cargado con  y leido exitosamente.</li>";
			//asigno permisos al archivo para que al finalizar todo el proceso me permita borrarlo
			chmod($destino.$archivo, 0777);
			//como ya se ha cargado el archivo al folder temporal procedo a leer la informacion
			//abro la carpeta del archivo que necesito leer el cual es el archivo temporal
			$fp = fopen ($destino.$archivo,"r");
			//declaro un contador el cual me permitira saber en que fila estoy
			$i 			= 0;
			//contador para la cantidad de registros
			$cantidad	=	0;
			//arreglo con la informacion
			$arreglo_archivo	= array();
			//recorro los datos del archivo CSV
			while (( $data = fgetcsv ($fp ,50000,$separador)) !== FALSE ) //@todo el numero 50000 debe cambiarse segun la cantidad de filas del archivo
			{ // Mientras hay líneas que leer... 
				//pongo en un arreglo la informacion que se saca del excel 
				array_push($arreglo_archivo,$data);
			}
			//declaro el arreglo donde ira toda la informacion
			$array_final2	=	array();
			//recorro la cantidad de arreglos
			for($a=1;$a<=count($arreglo_archivo);$a++)
			{
				//inicializo el arreglo temporal
				$array_final1	=	array();
				//recorro la cantidad de subnodos que tiene cada posicion
				for($i=2;$i<=count($arreglo_archivo[$a]);$i++)//@TODO ACA SE DICE DESDE QUE COLUMNA DEBE EMPEZAR A TOMAR DATOS. tratar de poenr numerito en variable
				{
					//creo el nuevo arreglo con las cabeceras como llaves
					$array_final1[$arreglo_archivo[0][$i]]=$arreglo_archivo[$a][$i];
				}
				//concateno nuevamente para dejar un solo arreglo
				array_push($array_final2,$array_final1);
			}
			//var_dump($array_final2);
			/*
			 * ahora teniendo el listado de productos y de atributos procedo a hacer la insercion.
			 * esta insercion debe hacerse de la siguiente forma.
			 * 1. Si el producto existe solo le actualizara la información.
			 * 2. Si el producto no existe le insertara los atributos
			 */
			//empiezo a recorrer el nuevo arreglo para guardar o actualizar segun sea el caso
			$arreglo_existentes	=	array();
			foreach($array_final2 as $key=>$productos)
			{
				//inicializo la variable que llevara los datos de insert de los atributos
				$set2	=	"";
				//inicializo la variable que llevara los datos de insert de los productos
				$set		=	"";
				$campos		=	"";
				$campos2	=	"";
				$valores	=	"";
				$valores2	=	"";	
				//verifico si el codigo de producto que lleva el documento ya existe
				$existe		=	$funciones->consultaUniversal('principal',' codproducto="'.$productos['codproducto'].'"');
				//PROCESO DE ACTUALIZACION DE LA INFORMACION
				if(count($existe) > 0)
				{
					//inicializo el contador que me dice el de columna hasta donde van los datos basicos
					$contador	=	0;
					//recorro los datos
					foreach($productos as $llave=>$valor)
					{
						//verifico que no tome la llave linea
						if($llave == 'tiendas')
						{
							$funciones->relacionTiendas($valor,$existe[0]['id']);
						}
						//verifico que no tome la llave linea ni la llave tiendas
						if($llave != 'tiendas')
						{
							//verifico que la llave venga vacia para que no me genere errores
							if(!empty($llave))
							{
								//aca es donde se dice que cuando ya sobrepase las celdas de los datos basicos
								if($contador <= 25)//@todo poner el numero 26 en una variable
								{
									//concateno los datos de insert de los productos
									$set	.=	$llave."='".$valor."',";
								}
								else
								{
									//concateno los datos de insert de los atributos
									$set2	.=	$llave."='".$valor."',";		
								}
								//incremento el contador
								$contador++;
							}
						}
						//verifico que no tome la llave linea ni la llave tiendas
						if($llave != 'linea')
						{
							//verifico que la llave venga vacia para que no me genere errores
							if(!empty($llave))
							{
								//aca es donde se dice que cuando ya sobrepase las celdas de los datos basicos
								if($contador <= 25)//@todo poner el numero 26 en una variable
								{
									//concateno los datos de insert de los productos
									$set	.=	$llave."='".$valor."',";
								}
								else
								{
									//concateno los datos de insert de los atributos
									$set2	.=	$llave."='".$valor."',";		
								}
								//incremento el contador
								$contador++;
							}
						}
						else//si es linea procedo a hacer la insercion
						{
							if(!empty($valor))
							{
								//primero valido si el producto no  exista, si es asi debo borrar y volver a insertar
								$query_valida_producto	=	sprintf("SELECT * FROM relacion_contenidos WHERE id=%s",$existe[0]['id']);
								//ejecuto la consulta
								$result_valida_producto	=	$db->Execute($query_valida_producto);
								//valido
								if($result_valida_producto->NumRows() > 0)
								{
									//borro
									$db->Execute("DELETE FROM relacion_contenidos WHERE id=".$existe[0]['id']);
									//inserto
									$query_insercion_relacion	=	$db->Execute(sprintf("INSERT INTO relacion_contenidos(id,id_padre) VALUES('%s','%s')",$existe[0]['id'],$valor));
								}
								else//solo inserto
								{
									//inserto
									$query_insercion_relacion	=	$db->Execute(sprintf("INSERT INTO relacion_contenidos(id,id_padre) VALUES('%s','%s')",$existe[0]['id'],$valor));
								}
							}
						}
						
					}
					//elimino la ultima coma de cada variable que concatene
					$set2		=	substr ($set2, 0, strlen($set2) - 1);
					$set		=	substr ($set, 0, strlen($set) - 1);
					//creo los dos querys
					//query de actualizacion de atributos
					$query_update_atributos	=	sprintf("UPDATE atributos SET %s WHERE producto=%s",$set2,$existe[0]['id']);
					//query actualizacion del producto
					$query_update_producto	=	sprintf("UPDATE principal SET %s WHERE id=%s",$set,$existe[0]['id']);
					//echo $query_update_producto;
					//empiezo a ejecutar las consultas
					//atributos
					$result_atributos		=	$db->Execute($query_update_atributos);
					//productos
					$result_productos		=	$db->Execute($query_update_producto);	
					
				}
				//PROCESO DE INSERCION DE LOS PRODUCTOS Y LOS ATRIBUTOS QUE NO EXISTAN
				else
				{
					//inicializo el contador que me dice el de columna hasta donde van los datos basicos
					$contador2	=	0;
					//recorro los datos
					foreach($productos as $llave=>$valor)
					{
						//verifico que no tome la llave linea
						if($llave == 'tiendas')
						{
							$tiendas_lista	=	$valor;
						}
						//verifico que no tome la llave linea ni tiendas
						if($llave != 'linea' and $llave != 'tiendas')
						{
							//verifico que la llave venga vacia para que no me genere errores
							if(!empty($llave))
							{
								//aca es donde se dice que cuando ya sobrepase las celdas de los datos basicos
								if($contador2 <= 25)//@todo poner el numero 26 en una variable
								{
									//concateno los datos de insert de los productos
									$campos		.=	$llave.",";
									$valores	.=	"'".$valor."',";
								}
								else
								{
									//concateno los datos de insert de los atributos
									$campos2		.=	$llave.",";
									$valores2		.=	"'".$valor."',";		
								}
								//incremento el contador
								$contador2++;
							}
						}
						if($llave == 'linea')//si es linea procedo a hacer la insercion
						{
							if(!empty($valor))
							{
								$linea	=	$valor;
							}
						}
						
					}
				   //elimino la ultima coma de cada variable que concatene
					$campos			=	substr ($campos, 0, strlen($campos) - 1);
					$valores		=	substr ($valores, 0, strlen($valores) - 1);
					//atributos
					$campos2			=	substr ($campos2, 0, strlen($campos2) - 1);
					$valores2		=	substr ($valores2, 0, strlen($valores2) - 1);
					//guardado
					$query_guardado_producto	=	sprintf("INSERT INTO principal (%s,id_padre,tipo_contenido) VALUES(%s,'%s','%s')",$campos,$valores,$id_padre,$tipo_contenido);
					//echo $query_guardado_producto; 
					//ejecuto la consulta del producto
					$result_producto			=	$db->Execute($query_guardado_producto) or die($query_guardado_producto);
					//obtengo el ultimo id insertado en la tabla principal
					$ultimo_id					=	$db->Insert_ID();
					//relaciono las tiendas con el nuevo producto ingresado
					$funciones->relacionTiendas($tiendas_lista,$ultimo_id);
					//consulta de insercion de atributos
					$query_guardado_atributos	=	sprintf("INSERT INTO atributos (%s,producto) VALUES(%s,'%s')",$campos2,$valores2,$ultimo_id);
					//ejecuto la consulta de los atributos
					$result_atributos			=	$db->Execute($query_guardado_atributos) or die($query_guardado_atributos);
					//inserto las lineas nuevas con el producto nuevo
					$query_insercion_relacion	=	$db->Execute(sprintf("INSERT INTO relacion_contenidos(id,id_padre) VALUES('%s','%s')",$ultimo_id,$linea));
				}
			}
			
			
			//cierro el archivo
			fclose($fp);
			unlink($destino.$archivo);

		}
		else
		{
			//declaro la variable de los mensajes para que el uaurio sepa lo que esta pasando.
			echo '<li>Error al Cargar el archivo .CSV</li>';
    		ob_flush();
    		flush();
		}
	}
	else
	{
		echo "<script>alert('Recuerde que solo puede cargar Archivos .CSV (Archivo de excel delimitado por comas)')</script>";
	}
} 
?>
<html>
	<head>
		<title>
			Multi carga de Productos
		</title>
		<style>
			body{background:#fff}
			.titulo{font-weight:bold;color:#005086}
		</style>
	</head>
	<body>
		<form name="form1" action="" method="post" enctype="multipart/form-data">
		<ul>
			<?
				if(isset($mensaje) and !empty($mensaje))
				{
					echo $mensaje;
				}
			?>
		</ul>
		<table align="center">
			<tr>
				<td class="titulo" colspan="2">
					<h1>Carga de Productos</h1>
				</td>	
			</tr>
			<tr>
				<td colspan="2">
					<li>Recuerde que el archivo que va a cargar debe ser de tipo CSV (Delimitado por comas)</li>
				</td>	
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="file" name="archivo">
					<input type="submit" name="cargar" value="Cargar">
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>