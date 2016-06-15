<div>
<?
/*
 * Archivo que permite crear los atributos del catalogo
 * @autor Farez Jair Prieto Castro
 * @date 25 Marzo de 2010
 * @version 1.0
 */
global $db;
global $id;
//realizo el query que me traera los atributos que estan creados en este momento en la tabla atributos
$query_atributos	=	sprintf("DESC atributos");
//ejecuto la consulta
$result_atributos	=	$db->Execute($query_atributos) or die("No pudo consultar los atributos archivo <b>agregar_atributos.php</b> linea ".__LINE__);
//arreglo que llevara la info del atributo
$atributos1			=	array();
//recorro el resultado
while(!$result_atributos->EOF)
{
	array_push($atributos1,$result_atributos->fields);
	$result_atributos->MoveNext();
}
$atributos	=	array();
foreach($atributos1 as $vuelta)
{
	//$info	=	array($vuelta['Field']=>$vuelta['Field']);
	array_push($atributos,strtolower($vuelta['Field']));
	
}
//sort($atributos);
//empiezo el proceso de creacion del atributo
if(isset($_POST['crear']))
{
	 //capturo el nombre del campo
	 $atributo	=	$_POST['nuevo'];
     //ahora debo verificar si la tabla a la cual le voy a insertar existe
	 $query_tabla	=	sprintf("DESC atributos",$tabla);
	 //ejecuto la consulta
	 $result_tabla	=	$db->Execute($query_tabla);
	 $campos_tabla	=	array();
	 while(!$result_tabla->EOF)
	 {
		array_push($campos_tabla,$result_tabla->fields['Field']);
		$result_tabla->MoveNext();
	 }
	 //busco si el atributo que van a crear ya existe
	 $verific	=	array_search($atributo,$campos_tabla);
	 if(empty($verific))
	 {
		 //tabla
		 $tabla		=	"atributos";
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
		 //creo el query de insercion
		 $query		=	sprintf("ALTER TABLE %s ADD %s VARCHAR(50) ",$tabla,$atributo);
		 //ejecuto el query
		 $result	=	$db->Execute($query);
		 //valido si se creo
		 if($result)
		 {
		 	$mensaje	=	sprintf("El atributo <b>%s</b> ha sido creado con exito.",$atributo);
		 }
		 else
		 {
		 	$mensaje	=	sprintf("El atributo <b>%s</b> no pudo ser creado.",$atributo);
		 }
	 }
	 else
	 {
	 	$mensaje	=	sprintf("El atributo <b>%s</b> ya existe en el sistema.",$atributo);
	 }
}
//si se dio la orden de modificar el atributo
if(isset($_GET['edit']))
{
	$valor_anterior	= 	$_GET['edit'];	
	$atributo		=	$_GET['edit'];	
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
		 //crea la sentencia de insercion
		 $query		=	sprintf("ALTER TABLE atributos CHANGE %s %s VARCHAR(30)",$valor_anterior,$atributo);
		 //ejecuto la consulta
		 $result	=	$db->Execute($query)or die("no se pudo cambiar el valor");
		 if($result)
		 {
			 //verifico
			if($result)
			{
				$msg_1	=	base64_encode('El_atibuto_se_ha_modificado_con_exito');
				echo "<script>document.location='index.php?id=".$id."&mensaje=".$msg_1."'</script>";
			}
			else
			{
				$msg_1	=	base64_encode('El_atibuto_no_se_pudo_modificar');
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
	 $tabla		=	"atributos";
	$query		=	sprintf("ALTER TABLE %s DROP %s ",$tabla,$_GET['del']);
	//ejecuto la consulta
	$result		=	$db->Execute($query) or die("no pudo borrar el atributo");
	//verifico
	if($result)
	{
		$msg_1	=	base64_encode('El_atibuto_se_ha_eliminado_con_exito');
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
				Crear Nuevo atributo
			</td>
			<td>
				<input type="text" name="nuevo" style="border:1px solid #ccc" value="<? echo (isset($atributo))?$atributo:'';?>">
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
	if(confirm("Esta seguro que desea borrar este atributo?") == true)
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
			<b>ATRIBUTOS CREADOS ACTUALMENTE</b>
		</td>
	</tr>
	<tr>
		<td align="center">
			<b>ATRIBUTO</b>
		</td>
		<td align="center">
			<b>ACCIONES</b>
		</td>
	</tr>
	<?
		sort($atributos);
		//var_dump($atributos);
		for($a=0;$a<=count($atributos);$a++)
		{
			//var_dump($info);
			if($atributos[$a] != 'producto')
			{
				   echo "<tr>
							<td>
								".str_replace("_"," ",$atributos[$a])."
							</td>
							<td align='center'>
								<a href='#' onClick='borrar(\"index.php?id=".$id."&del=".$atributos[$a]."\")'>Eliminar</a> | 
								<a href='index.php?id=".$id."&edit=".$atributos[$a]."'>Editar</a>
							</td>
						</tr>
				";
			}
		}
	?>
</table>
</div>