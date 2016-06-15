<?
require('core/PHPPaging.lib.php');
global $funciones;
global $smarty;
global $db;
/*Declaracion de variables*/
//id nodo
$nodo	=	(isset($_GET['nodo']))?$_GET['nodo']:1;
/*Informacion del contenido*/
$info			=	$funciones->infoNodo($nodo);
//arreglo vacio para las migas
$datos	=	array();
//creo la miga recursiva
$miga	=	$funciones->BusquedaRecursiva($nodo,$datos);
//texto del boton de guardado
$texto_boton	=	'Guardar';
//accion que mostrara el listado o el formulario
$mostrar_form	=	false;
//valido si se dio la orden de editar
if(isset($_GET['editar']))
{
	//texto del boton degun este caso
	$texto_boton	=	'Modificar';
	//muestra el form
	$mostrar_form	=	true;
	//leo la informacion del la base de datos
	$info_contenido		=	$funciones->infoNodo($_GET['editar']);
	$nodo_padre			=	$info_contenido[0]['nodo_padre'];
	$antetitulo			=	$info_contenido[0]['antetitulo'];
	$titulo				=	$info_contenido[0]['titulo'];
	$subtitulo			=	$info_contenido[0]['subtitulo'];
	$resumen			=	$info_contenido[0]['resumen'];
	$contenido			=	$info_contenido[0]['contenido'];
	$adjunto			=	$info_contenido[0]['adjunto'];
	$especificaciones	=	$info_contenido[0]['especificaciones'];
	$marca				=	$info_contenido[0]['marca'];
	$imagen				=	$info_contenido[0]['imagen'];
	$pie_imagen			=	$info_contenido[0]['pie_imagen'];
	$imagen_home		=	$info_contenido[0]['imagen_home'];
	$tipo_nodo			=	$info_contenido[0]['tipo_nodo'];
	$autor				=	$info_contenido[0]['autor'];
	$mail_autor			=	$info_contenido[0]['mail_autor'];
	$link				=	$info_contenido[0]['link'];
	$tipo_link			=	$info_contenido[0]['tipo_link'];
	$visible			=	$info_contenido[0]['visible'];
	$admin				=	$info_contenido[0]['admin'];
	$orden				=	$info_contenido[0]['orden'];
	//valido si se dio la orden de guardar
	if(isset($_POST['guardar']))
	{
		$nodo_padre			=	$funciones->obtenerVariable('nodo_padre,r');
		$antetitulo			=	$funciones->obtenerVariable('antetitulo');
		$titulo				=	$funciones->obtenerVariable('titulo,r');
		$subtitulo			=	$funciones->obtenerVariable('subtitulo,r');
		$resumen			=	$funciones->obtenerVariable('resumen');
		$contenido			=	$funciones->obtenerVariable('contenido');
		$adjunto			=	$funciones->obtenerVariable('adjunto');
		$especificaciones	=	$funciones->obtenerVariable('especificaciones');
		$marca				=	$funciones->obtenerVariable('marca');
		$imagen				=	$funciones->obtenerVariable('imagen');
		$pie_imagen			=	$funciones->obtenerVariable('pie_imagen');
		$imagen_home		=	$funciones->obtenerVariable('imagen_home');
		$tipo_nodo			=	$funciones->obtenerVariable('tipo_nodo');
		$autor				=	$funciones->obtenerVariable('autor');
		$mail_autor			=	$funciones->obtenerVariable('mail_autor');
		$link				=	$funciones->obtenerVariable('link');
		$tipo_link			=	$funciones->obtenerVariable('tipo_link');
		$visible			=	$funciones->obtenerVariable('visible');
		$admin				=	$funciones->obtenerVariable('admin');
		$orden				=	$funciones->obtenerVariable('orden');
		$final	=	$funciones->insertarDatos('principal',2,'nodo='.$nodo);
	}
}	

//valido si es nueva
if(isset($_GET['nueva']))
{
	$nodo_padre			=	$funciones->obtenerVariable('nueva');
	//muestra el form
	$mostrar_form	=	true;
	$texto_boton	=	'Guardar';
	if(isset($_POST['guardar']))
	{
		$nodo_padre			=	$funciones->obtenerVariable('nodo_padre,r');
		$antetitulo			=	$funciones->obtenerVariable('antetitulo');
		$titulo				=	$funciones->obtenerVariable('titulo,r');
		$subtitulo			=	$funciones->obtenerVariable('subtitulo,r');
		$resumen			=	$funciones->obtenerVariable('resumen');
		$contenido			=	$funciones->obtenerVariable('contenido');
		$adjunto			=	$funciones->obtenerVariable('adjunto');
		$especificaciones	=	$funciones->obtenerVariable('especificaciones');
		$marca				=	$funciones->obtenerVariable('marca');
		$imagen				=	$funciones->obtenerVariable('imagen');
		$pie_imagen			=	$funciones->obtenerVariable('pie_imagen');
		$imagen_home		=	$funciones->obtenerVariable('imagen_home');
		$tipo_nodo			=	$funciones->obtenerVariable('tipo_nodo');
		$autor				=	$funciones->obtenerVariable('autor');
		$mail_autor			=	$funciones->obtenerVariable('mail_autor');
		$link				=	$funciones->obtenerVariable('link');
		$tipo_link			=	$funciones->obtenerVariable('tipo_link');
		$visible			=	$funciones->obtenerVariable('visible');
		$admin				=	$funciones->obtenerVariable('admin');
		$orden				=	$funciones->obtenerVariable('orden');
		$final				=	$funciones->insertarDatos('principal',1);
	}
}


//debo empezar a traer la informacion del contenido
$ssql = sprintf("SELECT * FROM principal WHERE nodo_padre=%s",$nodo);
$paging=new PHPPaging;
$paging->paginasAntes(6);
$paging->paginasDespues(6);
if($_GET['ver'])
{
	$e_ssql=mysql_query($ssql);
	$numver=mysql_num_rows($e_ssql);
}
else
{
	$numver=50;
}
$paging->porPagina($numver);
$paging->agregarConsulta($ssql);
$paging->ejecutar();
if(!$paging->numTotalRegistros())
 {
	$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
}

$links = $paging->fetchNavegacion();

$tabla	 =	'<table align="center" width="100%" border="1" class="tablawidth nowitable">
						<tr>
							<td colspan="5" align="center"><b>'.strtoupper($info[0]['titulo']).' ('.$info[0]['nodo'].') <a href="?nodo='.$info[0]['nodo'].'&nueva='.$info[0]['nodo'].'" title="Nuevo Nodo">
													<img border="0" src="images/icons/new_blue.png">
												</a></b></td>
						</tr>
						<tr class="center">
							<td colspan="3"><b>
								P&aacute;ginas: ';
 
								if(!$_GET['ver'])
								{
									$links	 = $paging->fetchNavegacion();
									$tabla	.= $links;
								}
$tabla	.=	'</b></td>
			<td colspan="2">
				<b>Registros: </b>';
$tabla	.=	$paging->numTotalRegistros();
$tabla	.=	'</td>
			</tr>
						
						<form name="form" method="post" action="">
						<tr class="center">
                        	<td><b>ID NODO</b></td>
							<td><b>TITULO</b></td>
							<td><b>TIPO NODO</b></td>
							<td colspan="2"><b>ACCIONES</b></td>
						</tr>';

						while($rew = $paging->fetchResultado())
						{

								$tabla .= '<tr class="center">
											<td align="center">'.
												$rew['nodo'].'
											</td>
											<td align="left">'.
												$rew['titulo'].'
											</td>';
											switch($rew['tipo_nodo'])
											{
												case 0:
													$tabla .='<td>Default</td>';
													break;
												case 1:
													$tabla .='<td>Noticias</td>';
													break;
												case 2:
													$tabla .='<td>Subcatalogo</td>';
													break;			
												case 3:
													$tabla .='<td>Catalogo</td>';
													break;	
												case 4:
													$tabla .='<td>Galer&iacute;a de Im&aacute;genes</td>';
													break;
												case 5:
													$tabla .='<td>Aplicacion PHP</td>';
													break;
												case 6:
													$tabla .='<td>Home</td>';
													break;
												case 7:
													$tabla .='<td>Foro</td>';
													break;				
											}
											
											
								$tabla	.='	<td>
												<a href="?nodo='.$rew['nodo'].'" title="Ver Subcontenidos">
													<img src="images/icons/eye.png" title="Ver Subcontenidos" border="0">
												</a>
												<a href="?nodo='.$rew['nodo'].'&nueva='.$rew['nodo'].'" title="Nuevo Nodo">
													<img border="0" src="images/icons/new_blue.png">
												</a>
												<a href="?nodo='.$rew['nodo'].'&editar='.$rew['nodo'].'" title="Editar Nodo">
													<img border="0" src="images/icons/bullet_edit.png">
												</a>';
								if($rew['visible'] == 1)
								{
									$tabla	.=	'<img src="images/icons/control_power_blue.png" title="Desactivar" border="0">';	
								}
								else
								{
									$tabla	.=	'<img src="images/icons/control_power.png" title="Activar" border="0">';
								}
								
								$tabla	.=	' 
												<a href="">
													<img border="0" src="images/icons/decline.png" title="Eliminar Nodo">
												</a>	
											</td>
								</tr>';
						}
												
					$tabla	.=	'
						</form>
					</table>';


					
$smarty->assign('nodo_padre'			,$nodo_padre);
$smarty->assign('antetitulo'			,$antetitulo);
$smarty->assign('titulo'				,$titulo);
$smarty->assign('subtitulo'				,$subtitulo);
$smarty->assign('resumen'				,$resumen);
$smarty->assign('contenido'				,$contenido);
$smarty->assign('adjunto'				,$adjunto);
$smarty->assign('especificaciones'		,$especificaciones);
$smarty->assign('marca'					,$marca);
$smarty->assign('imagen'				,$imagen);
$smarty->assign('pie_imagen'			,$pie_imagen);
$smarty->assign('imagen_home'			,$imagen_home);
$smarty->assign('tipo_nodo'				,$tipo_nodo);
$smarty->assign('autor'					,$autor);
$smarty->assign('mail_autor'			,$mail_autor);
$smarty->assign('link'					,$link);
$smarty->assign('tipo_link'				,$tipo_link);
$smarty->assign('visible'				,$visible);
$smarty->assign('admin'					,$admin);
$smarty->assign('orden'					,$orden);

$smarty->assign('texto_boton'			,$texto_boton);
$smarty->assign('mostrar_form'			,$mostrar_form);

$smarty->assign('miga'					,$miga);
$smarty->assign('nodo'					,$nodo);
$smarty->assign('final'					,$final);

					
					
					
$smarty->assign('tabla',$tabla);
$smarty->assign('info_contenido',$info_contenido);
$smarty->display('interfaz/contenido.html');
?>