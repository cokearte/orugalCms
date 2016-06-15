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
if($div < 3)
{
	echo "<select name='opciones".$div."' onChange='cargarSelect(this.value,".$div.")' size='10'>";
}
else
{
	echo "<select name='opciones".$div."' onChange='asignaRelacion(\'".$id."\')' size='10'>";	
}
if($result->NumRows() > 0)
{
	while(!$result->EOF)
	{
		echo "<option value='".$result->fields['id']."'>".$result->fields['titulo']."</option>";
		$result->MoveNext();
	}
}
else
{
	echo "<option value=''>No hay resultados</option>";
}
echo "</select>";
?>