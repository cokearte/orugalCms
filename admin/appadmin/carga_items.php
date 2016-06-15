<div>
<?
/*
 * Archivo que permite crear las Marcas de los productos del catalogo
 * @autor Farez Jair Prieto Castro
 * @date 25 Marzo de 2010
 * @version 1.0
 */
//ini_set("display_errors",1);
global $db;
global $id;
$datos[0]['titulo']='Seleccione...';
$datos[0]['id']='0';
$datos[1]['titulo']='Preguntas Examen';
$datos[1]['id']='1';
$datos[2]['titulo']='Examen Modulo';
$datos[2]['id']='2';
$datos[3]['titulo']='Preguntas a Examen Final';
$datos[3]['id']='3';
$datos[4]['titulo']='Examen Final a Curso';
$datos[4]['id']='4';

extract($_GET);
//obtengo la informacion de la pregunta que se esta pasando por parametro
$info_dato			=	$funciones->infoId($padre);


$orden	=	(isset($_GET['orden']))?$_GET['orden']:'r.tipo ASC';
$tipo	=	(isset($_GET['tipo']))?$_GET['tipo']:0;
$texto_arriba	=	'Titulo del Contenido a relacionar <div style="font-size:0.8em;font-weight:bold">(Puede tambien digitar el codigo en caso de ser un producto)</div>';
$texto_abajo	=	'Titulo del Contenido al cual lo relacionara<div style="font-size:0.8em;font-weight:bold">(Puede tambien digitar el codigo en caso de ser un producto)</div>';
//ahora debo validar los datos que se le deben pasar a cada una de las cajas
if($tipo == 1)//accesorios a productos
{
	$caja_arriba	=	10;//tipo producto
	$texto_arriba	=	'Relaci&oacute;n de descargas Para el producto';
	$texto_abajo	=	'ACCESORIO';
	$link			=	'<a href="index.php?type=10">Volver a Productos</a>';
}
elseif($tipo == 2)//descargas de productos
{
	$caja_arriba	=	10;//tipo producto
	$texto_arriba	=	'Relaci&oacute;n de Accesorios para el producto';
	$texto_abajo	=	'DESCARGA';
	$link			=	'<a href="index.php?type=10">Volver a Productos</a>';
}
elseif($tipo == 3)//eventos a tiendas
{
	$caja_arriba	=	31;//tipo eventos
	$texto_arriba	=	'Asignar Eventos a la tienda';
	$texto_abajo	=	'EVENTO';
	$link			=	'<a href="index.php?id=12">Volver a Tiendas</a>';
}
elseif($tipo == 4)//eventos a academias
{
	$caja_arriba	=	31;//tipo_examen
	$texto_arriba	=	'Asignar Eventos a la academia';
	$texto_abajo	=	'EVENTO';
	$link			=	'<a href="index.php?id=15">Volver a Academias</a>';
}
elseif($tipo == 5)//productos a tiendas
{
	$caja_arriba	=	10;//tipo producto
	$texto_arriba	=	'Asignar productos a la tienda ';
	$texto_abajo	=	'PRODUCTO';
	$link			=	'<a href="index.php?id=12">Volver a Tiendas</a>';
}
elseif($tipo == 6)//productos a tiendas
{
	$caja_arriba	=	10;//tipo producto
	$texto_arriba	=	'Asignar productos Relacionados ';
	$texto_abajo	=	'PRODUCTO';
	$link			=	'<a href="index.php?id=12">Volver a Productos</a>';
}
elseif($tipo == 7)//vacantes area de trabajo
{
	$caja_arriba	=	33;//tipo producto
	$texto_arriba	=	'Asignar Vacantes';
	$texto_abajo	=	'Vacantes';
	$link			=	'<a href="index.php?id='.$_GET['volver'].'">Volver a Areas de trabajo</a>';
}

//consulto un listado de los contenidos tipo pregunta para que la asignen
$result_atributos	=	$db->Execute(sprintf("SELECT * FROM principal WHERE tipo_contenido=%s AND visible=1 AND eliminado=0 ORDER BY titulo ASC",$caja_arriba));

$atributos			=	array();
//recorro el resultado
while(!$result_atributos->EOF)
{
	//traigo las preguntas o los items relacionados para el id cargado para que se haga un pequeña persistencia
	$query_persist		=	$db->Execute(sprintf("SELECT * FROM relacion_universal WHERE id=%s AND id_padre=%s AND tipo =%s",$result_atributos->fields['id'],$padre,$tipo));
	//concateno en arreglo
	$persist			=	array();

	if($query_persist->NumRows() > 0)
	{
		$data	=	array("titulo"=>$result_atributos->fields['titulo'],
					"id"=>$result_atributos->fields['id'],
					"esta"=>'1');
	}
	else
	{
		$data	=	array("titulo"=>$result_atributos->fields['titulo'],
					"id"=>$result_atributos->fields['id'],
					"esta"=>'0');	
	}
	array_push($atributos,$data);
	$result_atributos->MoveNext();
}
sort($atributos);//ordeno los datos
//valido si se dio la orden de crar o de asignar la relacion
if(isset($_POST['enviar']))
{
	if(count($_POST['lista']) == 0)
	{
		echo "<script>alert('debe seleccionar por lo menos un item para relacionar')</script>";
	}
	else
	{
		//recorro el listado que trae el post
		$contador_nuevo		=	0;
		$contador_nuevo_2	=	0;
		$valores_a_insertar	=	'';
		foreach($_POST['lista'] as $insertar)
		{
			$valores_a_insertar		.=	sprintf("('%s','%s','%s'),",$insertar,$padre,$tipo);
			
			$contador_nuevo		++;	
		}
		if($contador_nuevo <= 20)
		{
			//lo primero que hago es borrar todo lo tenga relacionado ese padre con ese tipo para no tener que validar si ya cada seleccion esta.
			$query_borro_todo	=	$db->Execute(sprintf("DELETE FROM relacion_universal WHERE id_padre=%s AND tipo=%s",$padre,$tipo));
			//despues de quedar borrado todo, procedo a insertar las nuevas relaciones 
			$valores_a_insertar		 =	substr($valores_a_insertar,0,strlen($valores_a_insertar)-1);
			$query_inserta_nueva	 =	$db->Execute(sprintf("INSERT INTO relacion_universal (id,id_padre,tipo) VALUES %s",$valores_a_insertar));
			echo "<script>alert('Se insertaron ".$contador_nuevo." items');document.location='index.php?id=".$id."&padre=".$padre."&tipo=".$tipo."&volver=".$_GET['volver']."'</script>";
		}
		else
		{
			echo "<script>alert('Ud ha seleccionado ".$contador_nuevo." items, recuerde que solo puede seleccionar 20');</script>";
		}
	}
}
?>
<form method="post">
	<table width="100%" border="1">
		<tr>
			<td colspan="2">
				<? echo $texto_arriba; echo " ".$link;?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<h1>
				<?
					echo $info_dato[0]['titulo'];
				?>
				</h1>
			</td>
		</tr>
	</table>

<script>
function borrar(ruta)
{
	if(confirm("Esta seguro que desea borrar esta marca?") == true)
	{
		document.location	=	ruta;
	}
	else
	{
		return false;
	}
}
</script>
<table width="100%" border="1">
	<tr>
		<td align="center" colspan="4">
			<b>LISTADO</b>
		</td>
	</tr>
	<tr>
	<td align="center">
			<b><input type="checkbox" onClick="marcar(this)">SELECCION </b>
		</td>
		<td align="center">
			<b><?=$texto_abajo ?> </b>
	</tr>
	<?
		$contador	=	0;
		//var_dump($atributos);
		foreach($atributos as $info)
		{
			if($info['esta'] == '1')
			{
				echo "
					<tr>
						<td align='center'>
							<input type='checkbox' name='lista[]' value='".$info['id']."' checked>
						</td>
						<td>
							".$info['titulo']."
						</td>
					</tr>";
			}
			else
			{
				echo "
					<tr>
						<td align='center'>
							<input type='checkbox' name='lista[]' value='".$info['id']."'>
						</td>
						<td>
							".$info['titulo']."
						</td>
					</tr>";
			}
		}

	?>
			<tr>
			<td colspan="2" align="right">
				<input style="border:1px solid #666;background:#ccc" type="submit" value="Asignar <?=$lbl1 ?>" name="enviar">
			</td>
		</tr>
</table>
</form>
</div>