<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
global $db;
$idproducto		=	$_GET['producto'];
$idcategoria	=	$_GET['categoria'];
$accion			=	$_GET['accion'];
if($accion == 1)//relacionar
{
	//primero verifico si la relacion ya existe para no tener que crearla varias veces
	$query_verifica	=	$db->Execute(sprintf("SELECT * FROM relacion_contenidos WHERE id=%s",$idproducto,$idcategoria)) or die(sprintf("SELECT * FROM relacion_contenidos WHERE id=%s AND id_padre=%s",$idproducto,$idcategoria));
	//si trae resultados
/*	if($query_verifica->NumRows()>0)
	{
		echo "Este producto ya esta relacionado a una categoria. Primero debe borrar la relaci&oacute;n actual y volver a intentar";
	}
	//si no retorna datos empiezo a insertar en la base de datos 
	else
	{*/
		//consulto algo de la informacion de la categoria a la cual se va a asignar para que sea un poco mas visible para el usuario
		$query_categoria	=	$db->Execute(sprintf("SELECT * FROM principal WHERE id=%s",$idcategoria));
		$query_insert		=	$db->Execute(sprintf("INSERT INTO relacion_contenidos(id,id_padre) VALUES('%s','%s')",$idproducto,$idcategoria));
		//si se realizo la insercion 
		if($query_insert)
		{
			echo "El producto ha sido asignado a la categoria <b>'".$query_categoria->fields['titulo']."'</b>";
		}
		else
		{
			echo "El producto no pudo ser asignado a la categoria <b>'".$query_categoria->fields['titulo']."'</b>";
		}
	/*}*/
}
elseif($accion==0)//borrar relacion
{
	//consulto algo de la informacion de la categoria a la cual se va a asignar para que sea un poco mas visible para el usuario
	$query_categoria	=	$db->Execute(sprintf("SELECT * FROM principal WHERE id=%s",$idcategoria));
	//ejecuto la consulta de borrar
	$query_borrar	=	$db->Execute(sprintf("DELETE FROM relacion_contenidos WHERE id=%s AND id_padre= %s",$idproducto,$idcategoria));
	//valido si se borro
	if($query_borrar)
	{
		echo "La relacion con la categoria <b>".$query_categoria->fields['titulo']."</b> se ha borrado con exito.";
	}
	else
	{
		echo "La relacion con la categoria <b>".$query_categoria->fields['titulo']."</b> no pudo ser borrada.";
	}
	
}
?>