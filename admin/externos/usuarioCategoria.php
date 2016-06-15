<?
//archivo de guardado de la usuario
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
global $db;
extract($_GET);

//siempre voy a borrar la relacion
$queryBorrado	=	$db->Execute(sprintf("DELETE FROM rel_usuario_producto WHERE idusuario=%s AND id=%s",$usuario,$idcategoria));

if($accion == 1)//relacionar
{
	//primero verifico si la relacion ya existe para no tener que crearla varias veces
	$query_insert		=	$db->Execute(sprintf("INSERT INTO rel_usuario_producto(idusuario,id) VALUES('%s','%s')",$usuario,$idcategoria));
	echo '<a style="cursor:pointer" onclick="relacionarUsuarioArchivo('.$usuario.','.$idcategoria.',0)">Desasignar</a>';
	

}
elseif($accion==0)//borrar relacion
{
	echo '<a style="cursor:pointer" onclick="relacionarUsuarioArchivo('.$usuario.','.$idcategoria.',1)">Asignar</a>';	
}
?>