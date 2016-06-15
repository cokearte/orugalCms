<div>
<?
/*
 * Archivo que permite crear las Marcas de los productos del catalogo
 * @autor Farez Jair Prieto Castro
 * @date 25 Marzo de 2010
 * @version 1.0
 */
global $db;
global $id;
$datos[0]['titulo']='Seleccione...';
$datos[0]['id']='0';
$datos[1]['titulo']='Accesorios Productos';
$datos[1]['id']='1';
$datos[2]['titulo']='Descargas Productos';
$datos[2]['id']='2';
$datos[3]['titulo']='Eventos Tiendas';
$datos[3]['id']='3';
$datos[4]['titulo']='Eventos Academia';
$datos[4]['id']='4';
$datos[5]['titulo']='Tiendas Productos';
$datos[5]['id']='5';
$datos[6]['titulo']='Usuarios Vacantes';
$datos[6]['id']='6';

$orden	=	(isset($_GET['orden']))?$_GET['orden']:'r.tipo ASC';
$tipo	=	(isset($_GET['tipo']))?$_GET['tipo']:0;
//ahora debo validar los datos que se le deben pasar a cada una de las cajas
if($tipo == 1)//accesorios producto
{
	$caja_arriba	=	10;//tipo_producto
	$caja_abajo		=	10;//tipo_producto
}
elseif($tipo == 2)//descargas producto
{
	$caja_arriba	=	10;//tipo_producto
	$caja_abajo		=	10;//tipo_producto
}
elseif($tipo == 3)//Eventos Tiendas
{
	$caja_arriba	=	31;//tipoevento
	$caja_abajo		=	25;//tipo tienda
}
elseif($tipo == 4)//Eventos Academia
{
	$caja_arriba	=	31;//tipo evento
	$caja_abajo		=	27;//tipo academia
}
elseif($tipo == 5)//Tiendas Productos
{
	$caja_arriba	=	25;//tipo tienda
	$caja_abajo		=	10;//tipo_producto
}
//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
$query_atributos	=	sprintf("SELECT p.titulo,r.id,r.id_padre,r.tipo FROM relacion_universal as r,principal as p WHERE r.id=p.id AND r.tipo=%s ORDER BY p.titulo ASC",$tipo); 
//ejecuto la consulta
$result_atributos	=	$db->Execute($query_atributos) or die("No pudo consultar los atributos archivo <b>agregar_atributos.php</b> linea ".__LINE__);
//arreglo que llevara la info del atributo
$atributos			=	array();
//recorro el resultado
while(!$result_atributos->EOF)
{
	//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
	$query_atributos2	=	sprintf("SELECT titulo as padre FROM principal as p WHERE p.id=%s",$result_atributos->fields['id_padre']);
	//echo $query_atributos2;
	$result_atributos2	=	$db->Execute($query_atributos2);
	while(!$result_atributos2->EOF)
	{
		$data	=	array('titulo'=>$result_atributos->fields['titulo'],
						  'padre'=>$result_atributos2->fields['padre'],
						  'tipo'=>$result_atributos->fields['tipo']);
		array_push($atributos,$data);
		$result_atributos2->MoveNext();
	}
	$result_atributos->MoveNext();
}
//empiezo el proceso de creacion del atributo
if(isset($_POST['crear']))
{
	 //capturo el nombre del campo
	 $hijo	=	$_POST['ocultacont'];
	 $padre	=	$_POST['ocultapadre'];
	 $tipo	=	$_POST['tipo'];
     $tabla	=	'relacion_universal';
	 //creo el query de insercion
	 $query		=	sprintf("INSERT INTO %s (id,id_padre,tipo) VALUES('%s','%s','%s')",$tabla,$hijo,$padre,$tipo);
	 //ejecuto el query
	 $result	=	$db->Execute($query);
	 //valido si se creo
	 if($result)
	 {
	 	$mensaje	=	sprintf("La Relaci&oacute;n  ha sido creada con exito.",$atributo);
	 }
	 else
	 {
	 	$mensaje	=	sprintf("La Relaci&oacute;n no pudo ser creada.",$atributo);
	 }
}
//si se dio la orden de modificar el atributo
if(isset($_GET['edit']))
{
	$valor_anterior	= 	$_GET['edit'];	
	$atributo		=	$_GET['valor'];	
	//si dan la orden de guardar
	if(isset($_POST['editar']))
	{
		 $atributo	=	$_POST['nuevo'];
		 $atributo	=	str_replace(" ","_",$atributo);
		 $atributo	=	str_replace("á","a",$atributo);
		 $atributo	=	str_replace("é","e",$atributo);
		 $atributo	=	str_replace("í","i",$atributo);
		 $atributo	=	str_replace("ó","o",$atributo);
		 $atributo	=	str_replace("ú","u",$atributo);
		 $atributo	=	str_replace("&","",$atributo);
		 $atributo	=	str_replace("$","",$atributo);
		 $atributo	=	str_replace("/","",$atributo);
		 $atributo	=	str_replace("\/","",$atributo);
		 $atributo	=	str_replace("ä","a",$atributo);
		 $atributo	=	str_replace("ë","e",$atributo);
		 $atributo	=	str_replace("ï","i",$atributo);
		 $atributo	=	str_replace("ö","o",$atributo);
		 $atributo	=	str_replace("ü","u",$atributo);
		 $atributo	=	ucwords($atributo);
		 //crea la sentencia de insercion
		 $query		=	sprintf("UPDATE marcas SET marca='%s' WHERE id_marca=%s",$atributo,$_GET['edit']);
		 //ejecuto la consulta
		 $result	=	$db->Execute($query)or die("no se pudo cambiar el valor");
		 if($result)
		 {
			 //verifico
			if($result)
			{
				$msg_1	=	base64_encode('La_marca_se_ha_modificado_con_exito');
				echo "<script>document.location='index.php?id=".$id."&mensaje=".$msg_1."'</script>";
			}
			else
			{
				$msg_1	=	base64_encode('La_marca_no_se_pudo_modificar');
				echo "<script>document.location='index.php?id=".$id."&mensaje=".$msg_1."'</script>";
			}
		 }
	}
	//ALTER TABLE ejemplo CHANGE monto cantidad FLOAT(8,2)
}
//ahora valido si viene la orden de borrar la cuerda
if(isset($_GET['del']))
{
	 //tabla
	$tabla		=	"marcas";
	$query		=	sprintf("UPDATE %s SET eliminado=1 WHERE id_marca=%s",$tabla,$_GET['del']);
	//ejecuto la consulta
	$result		=	$db->Execute($query) or die("no pudo borrar la marca");
	//verifico
	if($result)
	{
		$msg_1	=	base64_encode('La_marca_se_ha_eliminado_con_exito');
		echo "<script>document.location='index.php?id=".$id."&mensaje=".$msg_1."'</script>";
	}
}
?>
<form method="post">
	<table width="100%" border="1">
		<tr>
			<td colspan="2">
				<?
					$msg =	base64_decode($_GET['mensaje']);
					$msg = (isset($_GET['mensaje']))? str_replace("_"," ",$msg):$mensaje;
					echo $msg; 
				?>
			</td>
		</tr>
		<tr>
			<td>
				Titulo del Contenido a relacionar <div style="font-size:0.8em;font-weight:bold">(Puede tambien digitar el codigo en caso de ser un producto)</div>
			</td>
			<td>
				<input type="text" autocomplete="off" name="cont" id="cont" style="border:1px solid #ccc" onkeypress="listacontenidos(this.value,this.id,<?=$caja_arriba ?>)" value="<? echo (isset($atributo))?$atributo:'';?>">
				<div id="textcont"  style="position:absolute;z-index:50;background: #fff;border:1px solid #000"></div>
				<input type="hidden" id="ocultacont" name="ocultacont">
			</td>
		</tr>
		<tr>
			<td>
				Titulo del Contenido al cual lo relacionara
				<div style="font-size:0.8em;font-weight:bold">(Puede tambien digitar el codigo en caso de ser un producto)</div>
			</td>
			<td>
				<input type="text" autocomplete="off" name="padre" style="border:1px solid #ccc" id="padre" onkeypress="listacontenidos(this.value,this.id,<?=$caja_abajo?>)" value="<? echo (isset($atributo))?$atributo:'';?>">
				<div id="textpadre" style="position:absolute;z-index:50;background: #fff;border:1px solid #000"></div>
				<input type="hidden" id="ocultapadre" name="ocultapadre">
			</td>
		</tr>
		<tr>
			<td>
				Tipo de Relaci&oacute;n
			</td>
			<td>
				<select name="tipo" style="border:1px solid #ccc" onlyread>
				<? 
					foreach($datos as $info_data)
					{
						if($info_data['id'] == $tipo)
						{
							echo '<option value="'.$info_data['id'].'" selected>'.$info_data['titulo'].'</option>';	
						}
						
					}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input style="border:1px solid #666;background:#ccc" type="submit" value="Crear Relaci&oacute;n" name="crear">
			</td>
		</tr>
	</table>
</form>
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
			<b>RELACIONES HECHAS HASTA EL MOMENTO</b>
		</td>
	</tr>
	<tr>
		<td align="center">
			<?
				echo "<b>ITEM</b>";
			?>
		</td>
		<td align="center">
			<?
				echo "<b>PADRE RELACIONADO</b>";
			?>
		</td>
		<td align="center">
			<?
				echo "<b>TIPO DE RELACION</b>";
			?>
		</td>
		<td align="center">
			<?
					echo "<b>ACCIONES</b>";
			?>
		</td>
	</tr>
	<?
		foreach($atributos as $info)
		{
			if($info['Field'] != 'producto')
			{
				echo "
						<tr>
							<td>
								".$info['titulo']."
							</td>
							<td>
								".$info['padre']."
							</td>
							<td>
								".$datos[$info['tipo']]['titulo']."
							</td>
							<td align='center'>
								<a href='#' onClick='borrar(\"index.php?id=".$id."&del=".$info['id_marca']."\")'>Eliminar</a>
							</td>
						</tr>
				";
			}
		}
	?>
</table>
</div>