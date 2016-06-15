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
$orden	=	(isset($_GET['orden']))?$_GET['orden']:'ASC';
//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
$query_atributos	=	sprintf("SELECT * FROM marcas WHERE eliminado=0 ORDER BY marca %s",$orden);
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
	 $atributo	=	$_POST['nuevo'];
     //ahora debo verificar si la tabla a la cual le voy a insertar existe
	 $query_tabla	=	sprintf("SELECT * FROM marcas WHERE eliminado=0 AND marca='%s'",$atributo);
	 //ejecuto la consulta
	 $result_tabla	=	$db->Execute($query_tabla);
	 if($result_tabla->NumRows()== 0)
	 {
		 //tabla
		 $tabla		=	"marcas";
		 //ahora debo proceder a eliminar caracteres especiales y espacion por que como ya se sabe la base de datos no recibe estos caracteres
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
		 //creo el query de insercion
		 $query		=	sprintf("INSERT INTO %s (marca) VALUES('%s')",$tabla,$atributo);
		 //ejecuto el query
		 $result	=	$db->Execute($query);
		 //valido si se creo
		 if($result)
		 {
		 	$mensaje	=	sprintf("La Marca <b>%s</b> ha sido creado con exito.",$atributo);
		 }
		 else
		 {
		 	$mensaje	=	sprintf("La Marca <b>%s</b> no pudo ser creado.",$atributo);
		 }
	 }
	 else
	 {
	 	$mensaje	=	sprintf("La Marca <b>%s</b> ya existe en el sistema.",$atributo);
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
				Crear Nueva Marca
			</td>
			<td>
				<input type="text" name="nuevo" style="border:1px solid #ccc" autocomplete="off" onkeypress="listacontenidos2(this.value,this.id)" id="padre" value="<? echo (isset($atributo))?$atributo:'';?>">
				<div id="textpadre" style="position:absolute;z-index:50;background: #fff;border:1px solid #000"></div>
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
		<td align="center" colspan="2">
			<b>MARCAS CREADAS ACTUALMENTE</b>
		</td>
	</tr>
	<tr>
		<td align="center">
			<?
				if(isset($_GET['orden']) and $_GET['orden'] == 'ASC')
				{
					echo "<b><a href='index.php?id=".$id."&orden=DESC'>MARCA</a></b>";
				}
				elseif(isset($_GET['orden']) and $_GET['orden'] == 'DESC')
				{
					echo "<b><a href='index.php?id=".$id."&orden=ASC'>MARCA</a></b>";
				}
				else
				{
					echo "<b><a href='index.php?id=".$id."&orden=DESC'>MARCA</a></b>";
				}
			?>
		</td>
		<td align="center">
			<?
				if(isset($_GET['orden']) and $_GET['orden'] == 'ASC')
				{
					echo "<b><a href='index.php?id=".$id."&orden=DESC'>ACCIONES</a></b>";
				}
				elseif(isset($_GET['orden']) and $_GET['orden'] == 'DESC')
				{
					echo "<b><a href='index.php?id=".$id."&orden=ASC'>ACCIONES</a></b>";
				}
				else
				{
					echo "<b><a href='index.php?id=".$id."&orden=DESC'>ACCIONES</a></b>";
				}
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
								".str_replace("_"," ",$info['marca'])."
							</td>
							<td align='center'>
								<a href='#' onClick='borrar(\"index.php?id=".$id."&del=".$info['id_marca']."\")'>Eliminar</a> | 
								<a href='index.php?id=".$id."&edit=".$info['id_marca']."&valor=".$info['marca']."'>Editar</a>
							</td>
						</tr>
				";
			}
		}
	?>
</table>
</div>