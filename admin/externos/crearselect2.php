<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');

$id		=	$_GET['id'];
$div	=	$_GET['div'];

$query	=	sprintf("SELECT * FROM principal WHERE id_padre=%s",$id);
$result	=	$db->Execute($query);
//recorro resultado
if($div < 2)
{
	echo "<select name='opciones".$div."' onChange='cargarSelect2(this.value,".$div.")'>";
	echo "<option value='0'>Subcategoria</option>";
}
else
{
	echo "<select name='opciones".$div."' onChange='asignaRelacion(\'".$id."\')'>";	
	echo "<option value='0'>Linea</option>";
}
if($result->NumRows() > 0)
{
	while(!$result->EOF)
	{
		echo "<option value='".$result->fields['id']."'>".utf8_encode($result->fields['titulo'])."</option>";
		$result->MoveNext();
	}
}
else
{
	echo "<option value=''>No hay resultados</option>";
}
echo "</select>";
?>