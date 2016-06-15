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
//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
$query_atributos	=	sprintf("SELECT * FROM producto_mes as pm,principal as p WHERE p.eliminado=0 AND p.id=pm.id");
//ejecuto la consulta
$result_atributos	=	$db->Execute($query_atributos) or die("No pudo consultar los atributos archivo <b>agregar_atributos.php</b> linea ".__LINE__);
//arreglo que llevara la info del atributo
$atributos			=	array();
//recorro el resultado
while(!$result_atributos->EOF)
{
	array_push($atributos,$result_atributos->fields);
	$result_atributos->MoveNext();
}
//empiezo el proceso de creacion del atributo
if(isset($_POST['crear']))
{
	 //capturo el nombre del campo
	 $atributo	=	$_POST['ocultapadre'];
	 $titulo	=	$_POST['padre'];
     //ahora debo verificar si la tabla a la cual le voy a insertar existe
	 $query_tabla	=	sprintf("SELECT * FROM producto_mes WHERE id='%s'",$atributo);
	 //ejecuto la consulta
	 $result_tabla	=	$db->Execute($query_tabla);
	 if($result_tabla->NumRows()== 0)
	 {
		 //tabla
		 $tabla		=	"producto_mes";
		 //creo el query de insercion
		 $query		=	sprintf("INSERT INTO %s (id) VALUES('%s')",$tabla,$atributo);
		 //ejecuto el query
		 $result	=	$db->Execute($query);
		 //valido si se creo
		 if($result)
		 {
		 	$mensaje	=	sprintf("El producto <b>%s</b> ha sido asignado como producto del mes.",$titulo);
		 }
		 else
		 {
		 	$mensaje	=	sprintf("El producto <b>%s</b> no pudo ser asignado como producto del mes.",$titulo);
		 }
	 }
	 else
	 {
	 	$mensaje	=	sprintf("El producto del mes solo puede ser uno, primero borre el existente y intente de nuevo.",$atributo);
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
	$tabla		=	"producto_mes";
	$query		=	sprintf("DELETE FROM %s WHERE id=%s",$tabla,$_GET['del']);
	//ejecuto la consulta
	$result		=	$db->Execute($query) or die("El producto del mes no pudo ser borrado");
	//verifico
	if($result)
	{
		$msg_1	=	base64_encode('El_producto_del _mes_ha_sido_borrado_exitosamente');
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
				Escriba el nombre del producto y luego seleccionelo de la lista
			</td>
			<td>
				<input type="text" autocomplete="off" name="padre" style="border:1px solid #ccc" id="padre" onkeypress="listacontenidos(this.value,this.id,10)" value="<? echo (isset($atributo))?$atributo:'';?>">
				<div id="textpadre" style="position:absolute;z-index:50;background: #fff;border:1px solid #000"></div>
				<input type="hidden" id="ocultapadre" name="ocultapadre">
				<?
					if(isset($_GET['edit']))
					{
						echo '<input style="border:1px solid #666;background:#ccc" type="submit" value="Modificar" name="editar">';		
					}
					else
					{
						echo '<input style="border:1px solid #666;background:#ccc" type="submit" value="Crear" name="crear">';
					}
				?>
				
			</td>
		</tr>
	</table>
</form>
<script>
function borrar(ruta)
{
	if(confirm("Esta seguro que desea borrar este producto del mes?, recuerde que esto simplemente lo borrara como producto del mes y no de la base de datos de producto.") == true)
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
		<td align="center">
			<B>PRODUCTO DEL MES</B>
		</td>
		<td align="center">
			<B>ACCIONES</B>
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
								".str_replace("_"," ",$info['titulo'])."
							</td>
							<td align='center'>
								<a href='#' onClick='borrar(\"index.php?id=".$id."&del=".$info['id']."\")'>Eliminar</a>
							</td>
						</tr>
				";
			}
		}
	?>
</table>
</div>