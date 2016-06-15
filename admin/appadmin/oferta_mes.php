<div>
<?
/*
 * Archivo que permite crear la relacion de las ofertas
 * @autor Farez Jair Prieto Castro
 * @date 25 Marzo de 2010
 * @version 1.0
 */
global $db;
global $id;
//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
$query_atributos	=	sprintf("SELECT * FROM ofertas as pm,principal as p WHERE p.eliminado=0 AND p.id=pm.id");
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
	 $query_tabla	=	sprintf("SELECT * FROM ofertas WHERE id='%s'",$atributo);
	 //ejecuto la consulta
	 $result_tabla	=	$db->Execute($query_tabla);
	 if($result_tabla->NumRows()== 0)
	 {
		 //tabla
		 $tabla		=	"ofertas";
		 //creo el query de insercion
		 $query		=	sprintf("INSERT INTO %s (id) VALUES('%s')",$tabla,$atributo);
		 //ejecuto el query
		 $result	=	$db->Execute($query);
		 //valido si se creo
		 if($result)
		 {
		 	$mensaje	=	sprintf("El producto <b>%s</b> ha sido asignado como oferta.",$titulo);
		 }
		 else
		 {
		 	$mensaje	=	sprintf("El producto <b>%s</b> no pudo ser asignado como oferta.",$titulo);
		 }
	 }
	 else
	 {
	 	$mensaje	=	sprintf("Este producto ya esta en el listado de ofertas.",$atributo);
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
		 $query		=	sprintf("UPDATE ofertas SET marca='%s' WHERE id_marca=%s",$atributo,$_GET['edit']);
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
if(isset($_POST['poner_oferta']))
{
	//para evitarme la validacion y el doble proceso del usuario borrando y asignando simplemente pondre la oferta actual con la banderita en 0 y asignare la nueva
	$query_cambio	=	$db->Execute(sprintf("UPDATE ofertas SET del_mes=0"));
	//valido que se halla hecho el proceso
	if($query_cambio)
	{
		extract($_POST);
		//ahora proceso a asignar la nueva oferta del mes. Capturo la nueva oferta
		//creo el query
		$query_oferta	=	$db->Execute(sprintf("UPDATE ofertas SET del_mes=1 WHERE id= %s",$oferta_mes)) or die(sprintf("UPDATE ofertas SET del_mes=1 WHERE id= %s",$oferta_mes));
		//valido que se halla hecho el proceso
		if($query_oferta)
		{
			$msg_1	=	base64_encode('La_oferta_fue_asignada_con_exito');
			echo "<script>document.location='index.php?id=".$id."&mensaje=".$msg_1."'</script>";
		}
	}
}
//ahora valido si viene la orden de borrar la cuerda
if(isset($_GET['del']))
{
	 //tabla
	$tabla		=	"oferta";
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
					echo "<b>".$msg."</b>"; 
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
	if(confirm("Esta seguro que desea borrar esta oferta?") == true)
	{
		document.location	=	ruta;
	}
	else
	{
		return false;
	}
}
</script>
<form method="post">
<table width="100%" border="1">

	<tr>
		<td align="center">
			<B>PRODUCTO</B>
		</td>
		<td align="center">
			<B>OFERTA DEL MES</B>
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
							<td align='center'>";
								if($info['del_mes'] == 1)
								{
									echo "<input type='radio' name='oferta_mes' value='".$info['id']."' checked>";
								}	
								else
								{
									echo "<input type='radio' name='oferta_mes' value='".$info['id']."'>";
								}
							echo "</td>
							<td align='center'>
								<a href='#' onClick='borrar(\"index.php?id=".$id."&del=".$info['id']."\")'>Eliminar</a>
							</td>
						</tr>
				";
			}
		}
	?>
	<tr>
		<td align="center">
			
		</td>
		<td align="center">
			<input type="submit" value="Seleccionar Oferta del Mes" name="poner_oferta">
		</td>
		<td align="center">
			
		</td>
	</tr>
</table>
</form>
</div>