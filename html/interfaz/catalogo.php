<div id="vid_gen">
<?

global $funciones;
global $core;
global $id;
$info_id	=	$core->info_id;
$estrella	=	5;
$logueado	=	$logueado;
//asigno a smarty
$lateral_catalogo = "php/filtros.php";

if(isset($_SESSION['login']))
{
	$logueado	=	true;
	$session 	= 	$_SESSION['login'];
}
else
{
	$logueado	=	false;
}

if(isset($_GET['search']))
{
	$limit	=	(isset($_POST['limite']))?$_POST['limite']:5;
	//debo traer todas las marcas de bajos que existan en la base de datos
	$query_marcas	=	sprintf("SELECT marca FROM %s WHERE marca !='' GROUP BY marca",_TABLA_PRINCIPAL);
	//ejecuto esa consulta
	$result_marcas	=	$db->Execute($query_marcas);
	//declaro el arreglo de las marcas
	$marcas			=	array();
	//recorro el resultado
	while(!$result_marcas->EOF)
	{
		array_push($marcas,$result_marcas->fields);
		$result_marcas->MoveNext();	
	}
	
	//valido si viene la variable nm
	if(isset($_GET['nm']))
	{
		//valido si viene el POST marca
		if(isset($_POST['marca']))
		{
			$marca	=	$_POST['marca'];
			$hijos	=	$funciones->obtenerListado($id,'AND marca="'.$marca.'"',$limit);	
		}
		else
		{
			$hijos	=	$funciones->obtenerListado($id,'',$limit);
		}
		$hijos2	=	$funciones->obtenerListado($_GET['nm']);	
		
	}
	else
	{	
		$hijos2	=	$funciones->obtenerListado($id);
		$hijos	=	$funciones->obtenerListado($id,'',$limit);
	}
	include(_PLANTILLAS.'interfaz/catalogo_search.html');
}
elseif(isset($_GET['view']))
{
	$comentarios	=	$funciones->consultaUniversal('comentarios as c,usuarios as u ',sprintf(' c.id=%s AND u.idusuario=c.idusuario ',$id));
	//valido si la sesion esta abierta
	if(isset($_SESSION['login']))
	{
		//consulto de la tabla de la relacion del producto por el usuario si el producto actual ya esta relacionado
		$query_verifica		=	sprintf("SELECT * FROM rel_usuario_producto WHERE idusuario=%s AND id=%s",$_SESSION['login']['idusuario'],$id);
		//ejecuto la consulta
		$result_verifica	=	$db->Execute($query_verifica);
		//si esto me retorna datos quiere decir que el usuario ya lo selecciono como producto preferido
		if($result_verifica->NumRows() > 0)
		{
			//ya esta seleccionado
			$seleccionado	=	true;
		}
		else
		{
			//no esta seleccionado
			$seleccionado	=	false;
		}
	}
	$hijos	=	$core->info_id_hijos;
	include(_PLANTILLAS.'interfaz/catalogo_view.html');
}
//si se dio la orden de ver ellistado del usuario
elseif(isset($_GET['lista']))
{
	$listado		=	$funciones->getProductoUsuario($_SESSION['login']['idusuario']);
	//recorro para sacar los campos que necesito
	$listado_final	=	array();
	foreach($listado as $info)
	{
		$data	=	array("titulo"=>$info['titulo'],
		      "resumen"=>html_entity_decode(nl2br(utf8_encode($info['resumen']))),
			  "id"=>$info['id'],
		      "subtitulo"=>$info['subtitulo'],
		 	  "imagen"=>$info['imagen'],
			  "prom_votos"=>$funciones->obtenerPromedioVotos($info['id']));
		array_push($listado_final,$data);
	}
	//$smarty->assign("hijos"						,$core->info_id_hijos);
	$preferidos	=	$listado_final;
	include(_PLANTILLAS.'interfaz/mi-lista.html');
}
else
{
	$hijos	=	$funciones-> obtenerListado($id);
	$contador	=	0;
	include($lateral_catalogo);
	echo '	<table style="width:700px;float:right">
				<tr>';
	foreach($hijos as $datos)
	{
		if((($contador %3) == 0) && $contador !=0)
		{
			echo '<tr>';
		}
		echo '
			<td align="center">
				<table>
					<tr>
						<td align="center">
							<a href="index.php?id='.$datos['id'].'&search"><img src="images/'.$datos['imagen'].'" width="140" height="274" /></a>
						</td>
					</tr>
					<tr>	
						<td align="center">
							<a href="index.php?id='.$datos['id'].'&search">'.$datos['titulo'].'</a>
						</td>
					</tr>
				</table>
			</td>
		';
		$contador++;
	}
	echo '</tr>
	</table>';
}	
?>
</div>
 