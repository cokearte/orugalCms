<?php
require('core/PHPPaging.lib.php');
global $funciones;
global $db;
/*Declaracion de variables*/
//id id
if(isset($_SESSION['login']))
{
	if($_SESSION['login']['perfil'] == 1)//administrador
	{
		$id				=	(isset($_GET['id']))?$_GET['id']:1;		
	}
	else//usuario con permisos sobre algun sitio
	{
		$id				=	(isset($_GET['id']))?$_SESSION['login']['telefono']:$_SESSION['login']['telefono'];
	}
}
$query_sites	=	$funciones->infoId($_SESSION['login']['telefono']);

$info_id		=	$funciones->infoId($id);
$fecha			=	date("Y-m-d H:i:s");
//listado de marcas
$marcas			=	$funciones->consultaUniversal('principal','id_padre=10 ORDER BY marca ASC');
$orden1			=	(isset($_GET['orden']))?base64_decode($_GET['orden']):'';	
if(!empty($orden1))
{
	if($orden1 == 'titulo DESC')
	{
		$orden			=	'titulo ASC';
	}
	else
	{
		$orden			=	'titulo DESC';
	}
}
else
{
	$orden			=	'orden ';
}
//aca se valida si se dio la orden de esportar el excel
if(isset($_GET['export']))
{  	
	$funciones->exportaExcel();
}
//primero que todo debo saber el tipo de contenido del nodo visitado
if(isset($_GET['type']))
{
	
	if($_GET['type']	==	_TIPO_CATALOGO)
	{
		$tipo_contenido	=	_TIPO_CATEGORIA;
	}
	elseif($_GET['type']	==	_TIPO_CATEGORIA)
	{
		$tipo_contenido	=	_TIPO_SUBCATEGORIA;
	}
	elseif($_GET['type']	==	_TIPO_SUBCATEGORIA)
	{
		$tipo_contenido	=	_TIPO_LINEA;
	}
	elseif($_GET['type']	==	_TIPO_DESCARGA)
	{
		$tipo_contenido	=	_TIPO_ARCHIVO;
	}
	elseif($_GET['type']	==	_TIPO_GALERIA_VIDEO)
	{
		$tipo_contenido	=	_TIPO_VIDEO;
	}
	elseif($_GET['type']	==	_TIPO_NOTICIA)
	{
		$tipo_contenido	=	_TIPO_SUBNOTICIA;
	}
	elseif($_GET['type']	==	_TIPO_SUBNOTICIA)
	{
		$tipo_contenido	=	_TIPO_TITULARES;
	}
	elseif($_GET['type']	==	_TIPO_TITULARES)
	{
		$tipo_contenido	=	_TIPO_TITULAR;
	}
	elseif($_GET['type']	==	_TIPO_JUGADORES)
	{
		$tipo_contenido	=	_TIPO_JUGADOR;
	}
	elseif($_GET['type']	==	_TIPO_GALERIA_IMAGEN)
	{
		$tipo_contenido	=	_TIPO_IMAGEN;
	}
	elseif($_GET['type']	==	_TIPO_ATRIBUTO)
	{
		$tipo_contenido	=	_TIPO_SUBATRIBUTO;
	}
	elseif($_GET['type']	==	_TIPO_TIENDA)
	{
		$tipo_contenido	=	_TIPO_SUBTIENDA;
	}
	elseif($_GET['type']	==	_TIPO_SUBTIENDA)
	{
		$tipo_contenido	=	_TIPO_SUBTIENDA;
	}
	elseif($_GET['type']	==	_TIPO_ACADEMIA)
	{
		$tipo_contenido	=	_TIPO_SUBACADEMIA;
	}
	elseif($_GET['type']	==	_TIPO_SUBACADEMIA)
	{
		$tipo_contenido	=	_TIPO_SUBACADEMIA;
	}
	elseif($_GET['type']	==	_TIPO_OFERTERO)
	{
		$tipo_contenido	=	_TIPO_SUBOFERTERO;
	}
	elseif($_GET['type']	==	_TIPO_EVENTOS)
	{
		$tipo_contenido	=	_TIPO_SUBEVENTOS;
	}
	elseif($_GET['type']	==	_TIPO_SUBEVENTOS)
	{
		$tipo_contenido	=	21;
	}
	elseif($_GET['type']	==	_TIPO_VACANTES)
	{
		$tipo_contenido	=	_TIPO_SUBVACANTES;
	}
	elseif($_GET['type']	==	_TIPO_SUBVACANTES)
	{
		$tipo_contenido	=	34;
	}
	elseif($_GET['type']	==	_TIPO_PRODUCTO)
	{
		
		$tipo_contenido	=	_TIPO_PRODUCTO;
	}
	elseif($_GET['type']	==	35)
	{
		$tipo_contenido	=	35;
	}
	elseif($_GET['type']	==	36)
	{
		$tipo_contenido	=	36;
	}
	elseif($_GET['type']	==	37)
	{
		$tipo_contenido	=	37;
	}
	elseif($_GET['type']	==	40)
	{
		$tipo_contenido	=	41;
	}
	elseif($_GET['type']	==	41)
	{
		$tipo_contenido	=	42;
	}
	elseif($_GET['type']	==	42)
	{
		$tipo_contenido	=	43;
	}
	elseif($_GET['type']	==	44)
	{
		$tipo_contenido	=	45;
	}
	elseif($_GET['type']	==	47)
	{
		$tipo_contenido	=	48;
	}
	elseif($_GET['type']	==	48)
	{
		$tipo_contenido	=	49;
	}
	elseif($_GET['type']	==	50)
	{
		$tipo_contenido	=	51;
	}
	elseif($_GET['type']	==	51)
	{
		$tipo_contenido	=	52;
	}
	elseif($_GET['type']	==	53)
	{
		$tipo_contenido	=	54;
	}
	elseif($_GET['type']	==	55)
	{
		$tipo_contenido	=	56;
	}
	elseif($_GET['type']	==	57)
	{
		$tipo_contenido	=	58;
	}
	elseif($_GET['type']	==	59)
	{
		$tipo_contenido	=	60;
	}
	elseif($_GET['type']	==	5)
	{
		$tipo_contenido	=	31;
	}
	else
	{
		$tipo_contenido	=	$_GET['type'];
	}
}
else
{
	$tipo	=	$funciones->obtenerTipoNodo($id);
	
	if($tipo	==	_TIPO_CATALOGO)
	{
		$tipo_contenido	=	_TIPO_CATEGORIA;
	}
	elseif($tipo	==	_TIPO_CATEGORIA)
	{
		$tipo_contenido	=	_TIPO_SUBCATEGORIA;
	}
	elseif($tipo	==	_TIPO_SUBCATEGORIA)
	{
		$tipo_contenido	=	_TIPO_LINEA;
	}
	elseif($tipo	==	_TIPO_DESCARGA)
	{
		$tipo_contenido	=	_TIPO_ARCHIVO;
	}
	elseif($tipo	==	_TIPO_GALERIA_VIDEO)
	{
		$tipo_contenido	=	_TIPO_VIDEO;
	}
	elseif($tipo	==	_TIPO_NOTICIA)
	{
		$tipo_contenido	=	_TIPO_SUBNOTICIA;
	}
	elseif($tipo	==	_TIPO_SUBNOTICIA)
	{
		$tipo_contenido	=	_TIPO_TITULARES;
	}
	elseif($tipo	==	_TIPO_TITULARES)
	{
		$tipo_contenido	=	_TIPO_TITULAR;
	}
	elseif($tipo	==	_TIPO_JUGADORES)
	{
		$tipo_contenido	=	_TIPO_JUGADOR;
	}
	elseif($tipo	==	_TIPO_GALERIA_IMAGEN)
	{
		$tipo_contenido	=	_TIPO_IMAGEN;
	}
	elseif($tipo	==	_TIPO_ATRIBUTO)
	{
		$tipo_contenido	=	_TIPO_SUBATRIBUTO;
	}
	elseif($tipo	==	_TIPO_TIENDA)
	{
		$tipo_contenido	=	_TIPO_SUBTIENDA;
	}
	elseif($tipo	==	_TIPO_SUBTIENDA)
	{
		$tipo_contenido	=	_TIPO_SUBTIENDA;
	}
	elseif($tipo	==	_TIPO_ACADEMIA)
	{
		$tipo_contenido	=	_TIPO_SUBACADEMIA;
	}
	elseif($tipo	==	_TIPO_SUBACADEMIA)
	{
		$tipo_contenido	=	_TIPO_SUBACADEMIA;
	}
	elseif($tipo	==	_TIPO_OFERTERO)
	{
		$tipo_contenido	=	_TIPO_SUBOFERTERO;
	}
	elseif($tipo	==	_TIPO_EVENTOS)
	{
		$tipo_contenido	=	_TIPO_SUBEVENTOS;
	}
	elseif($tipo	==	_TIPO_SUBEVENTOS)
	{
		$tipo_contenido	=	21;
	}
	elseif($tipo	==	_TIPO_VACANTES)
	{
		$tipo_contenido	=	_TIPO_SUBVACANTES;
	}
	elseif($tipo	==	_TIPO_SUBVACANTES)
	{
		$tipo_contenido	=	34;
	}
	elseif($tipo	==	_TIPO_PRODUCTO)
	{
		$tipo_contenido	=	_TIPO_PRODUCTO;//tipo reseña
	}
	elseif($tipo	==	35)
	{
		$tipo_contenido	=	35;
	}
	elseif($tipo	==	36)
	{
		$tipo_contenido	=	36;
	}
	elseif($tipo	==	37)
	{
		$tipo_contenido	=	37;
	}elseif($tipo	==	40)
	{
		$tipo_contenido	=	41;
	}
	elseif($tipo	==	41)
	{
		$tipo_contenido	=	42;
	}
	elseif($tipo	==	42)
	{
		$tipo_contenido	=	43;
	}
	elseif($tipo ==	44)
	{
		$tipo_contenido	=	45;
	}
	elseif($tipo	==	47)
	{
		$tipo_contenido	=	48;
	}
	elseif($tipo	==	48)
	{
		$tipo_contenido	=	49;
	}
	elseif($tipo	==	50)
	{
		$tipo_contenido	=	51;
	}
	elseif($tipo	==	51)
	{
		$tipo_contenido	=	52;
	}
	elseif($tipo	==	53)
	{
		$tipo_contenido	=	54;
	}
	elseif($tipo	==	55)
	{
		$tipo_contenido	=	56;
	}
	elseif($tipo	==	57)
	{
		$tipo_contenido	=	58;
	}
	elseif($tipo	==	59)
	{
		$tipo_contenido	=	60;
	}
	elseif($tipo	==	5)
	{
		$tipo_contenido	=	31;
	}
	else
	{
		$tipo_contenido	=	$tipo;
	}	
}

//echo $tipo_contenido;
/*Informacion del contenido*/

$info			=	$funciones->infoId($id);
//arreglo vacio para las migas
$datos	=	array();
//creo la miga recursiva
if(!isset($_GET['type']))
{
	$miga	=	$funciones->BusquedaRecursiva($id,$datos);
}

//texto del boton de guardado
$texto_boton	=	'Guardar';
//accion que mostrara el listado o el formulario
$mostrar_form	=	false;

//inicialmente debo traer el listado de items del catalogo de productos
$listado_catalogo	=	$funciones->obtenerListado(_CATALOGO,'',20);

$editar			=	false;
//valido si se dio la orden de editar
if(isset($_GET['editar']))
{
	$editar			=	true;
	//texto del boton degun este caso
	$texto_boton	=	'Modificar'; 
	if($tipo_contenido==10)
	{
			$texto_boton	.= " Producto";
	}
	//muestra el form
	$mostrar_form	=	true;
	//leo la informacion del la base de datos
	$info_contenido		=	$funciones->infoId($_GET['editar']);
//	var_dump($info_contenido);
	
	//realizare una persistencia completamente dinamica recorriendo el arreglo que me retorna el sistema
	foreach($info_contenido as $info)
	{
		//en esta parte se declaran las variables para hacer la persistencia
		foreach($info as $llave=>$valor)
		{
			@eval("$".$llave." = '".$valor."';");
		}
	}
	//var_dump($_POST);die();
	//valido si se dio la orden de guardar
	if(isset($_POST['guardar']))
	{
		//declaro las variables para la persistencia
		foreach($_POST as $llave=>$valor)
		{
			//valido si el key del post lleva la sintaxsis campo,r para eliminar la r para que la variable se declare con la (,r)
			if(eregi('^[a-z]+,{1}(r){1}$',$llave))
			{
				//si encuentra la expresion elimina  los dos ultimos caracteres
				$llave		=	substr ($llave, 0, strlen($llave) - 2);
				//en esta linea de codigo se declaran todas las variables para la persistencia del formulario de cualquier tipo
				@eval("$".$llave." = '".$valor."';");
			}
			else
			{
				//en esta linea de codigo se declaran todas las variables para la persistencia del formulario de cualquier tipo
				@eval("$".$llave." = '".$valor."';");
			}	
		}
		$final				=	$funciones->insertarDatos('principal',2,'id='.$id);
		echo "<script>alerta('Proceso de guardado','".strip_tags($final)."','info',function(){document.location='index.php?id=".$id."&editar=".$id."'});</script>";
	}
	//valido si dio la orden de guadar los atributos
	if(isset($_POST['guardar_atrib']))
	{
		$final				=	$funciones->insertarDatos('atributos',2,'producto='.$id);
		echo "<script>alert('".strip_tags($final)."')</script>";	
	}
}	
//valido si viene la variable tipo
if(isset($_GET['type']))
{
	
	//capturo el valor de type
	$tipo	=	$_GET['type'];

	if(isset($_POST['buscar']))
	{
		
		//debo realizar el query teniendo en cuenta lo que se este consultando
		//debo empezar a traer la informacion del contenido	
		$ssql = sprintf("SELECT * FROM principal WHERE tipo_contenido=%s AND titulo like'%s' OR codproducto LIKE '%s' AND eliminado=0 ORDER BY %s",$tipo,"%".$_POST['texto']."%","%".$_POST['texto']."%",$orden);
	}
	elseif(isset($_POST['buscar2']))
	{
		//debo realizar el query teniendo en cuenta lo que se este consultando
		//debo empezar a traer la informacion del contenido	
		if(isset($_POST['opciones2']) and $_POST['opciones2'] != 0)
		{
			$valor	=	$_POST['opciones2'];
		}
		elseif(isset($_POST['opciones1']) and $_POST['opciones1'] != 0)
		{
			$valor	=	$_POST['opciones1'];
		}
		else
		{
			$valor	=	$_POST['opciones0'];
		}
		//ahora creo el sql
		$ssql = sprintf("SELECT * FROM principal as p,relacion_contenidos as r WHERE r.id_padre=%s AND p.tipo_contenido=%s AND p.id=r.id ",$valor,$tipo);
		//echo $ssql; 
	}
	else
	{
		
		//debo realizar el query teniendo en cuenta lo que se este consultando
		//debo empezar a traer la informacion del contenido	
		$ssql = sprintf("SELECT * FROM principal WHERE tipo_contenido=%s AND eliminado=0 ORDER BY %s",$tipo,$orden);
		
	}
	//echo $ssql;
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
		$numver=20;
	}
	
	$paging->porPagina($numver);
	$paging->agregarConsulta($ssql);
	$paging->ejecutar();
	if(!$paging->numTotalRegistros())
	 {
		$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
	}
	
	$links = $paging->fetchNavegacion();
}
else
{
	
	if(isset($_POST['buscar']))
	{
		//debo realizar el query teniendo en cuenta lo que se este consultando
		//debo empezar a traer la informacion del contenido	
		$ssql = sprintf("SELECT * FROM principal WHERE id_padre=%s AND titulo like'%s' OR codproducto LIKE '%s' AND eliminado=0 ORDER BY %s",$id,"%".$_POST['texto']."%","%".$_POST['texto']."%",$orden);
	}
	else
	{
		//debo empezar a traer la informacion del contenido
		$ssql = sprintf("SELECT * FROM principal WHERE id_padre=%s AND eliminado=0  ORDER BY %s",$id,$orden);
	}
	//echo $ssql; 
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
		$numver=20;
	}
	$paging->porPagina($numver);
	$paging->agregarConsulta($ssql);
	$paging->ejecutar();
	if(!$paging->numTotalRegistros())
	 {
		$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
	}
	
	$links = $paging->fetchNavegacion();
}

//valido si es nueva
if(isset($_GET['nueva']))
{
	$id_padre			=	(isset($_GET['type']) and $_GET['type'] == 10)?'0':$funciones->obtenerVariable('nueva');
	$destacado			=	(isset($_POST['destacado']))?$_POST['destacado']:1;
	//debo detectar el tipo de contenido que se va a crear
	$tipo_contenido_1	=	(isset($_GET['type']))?$_GET['type']:$funciones->infoId($id_padre);
	//detecto el tipo
	$tipo_contenido		=	$_GET['type'];
	//muestra el form
	$mostrar_form	=	true;
	$texto_boton	=	'Guardar';
	if(isset($_POST['guardar']))
	{
		//declaro las variables para la persistencia
		foreach($_POST as $llave=>$valor)
		{
			//valido si el key del post lleva la sintaxsis campo,r para eliminar la r para que la variable se declare con la (,r)
			if(eregi('^[a-z]+,{1}(r){1}$',$llave))
			{
				//si encuentra la expresion elimina  los dos ultimos caracteres
				$llave		=	substr ($llave, 0, strlen($llave) - 2);
				//en esta linea de codigo se declaran todas las variables para la persistencia del formulario de cualquier tipo
				@eval("$".$llave." = '".$valor."';");
			}
			else
			{
				//en esta linea de codigo se declaran todas las variables para la persistencia del formulario de cualquier tipo
				@eval("$".$llave." = '".$valor."';");
			}	
		}
		$final	=	$funciones->insertarDatos('principal',1);
		//selecciono la ultima categoria creada en el sistema para enrutar a ella en modo edicion
		$query_ultimo	=	$db->Execute(sprintf("SELECT MAX(id) as ultimo FROM principal"));
		echo "<script>alerta('Proceso de guardado','".strip_tags($final)."','info',function(){document.location='index.php?id=".$query_ultimo->fields['ultimo']."&editar=".$query_ultimo->fields['ultimo']."'})</script>";
	}
}
//valido si dio la orden de subir el contenido de orden
if(isset($_GET['acc']))
{
	//llamo la funcion que hace el nuevo orden
	$ordenar =	$funciones->reordenarContenido($_GET['acc'],$_GET['id_orden'],$_GET['orden'],$id);
	if($ordenar)
	{
		echo "<script>document.location='index.php?id=".$_GET['id']."'</script>";
	}
}
//comportamiento del eliminado de contenidos
if(isset($_POST['eliminar'])){
	
	$id = implode(",",$funciones->obtenerVariable("campos"));
	$final = $funciones->eliminarTabla('principal',$id);
	if($final == true)
	{
		if(isset($_GET['type']))
		{
			echo "<script>alert('Contenido Borrado con exito');document.location='index.php?type=".$_GET['type']."'</script>";
		}
		else
		{
			echo "<script>alert('Contenido Borrado con exito');document.location='index.php?id=".$_GET['id']."'</script>";
		}
	}
	else
	{
		echo "<script>alert('El Contenido no pudo ser Borrado. Rrevise que no tenga subcontenido');</script>";
	}
	$id = 0;
}
//comportamiento del eliminado de contenidos
if(isset($_POST['activar']))
{
	foreach($_POST['campos'] as $datos_final)
	{
		$final = $funciones->habilitaContenidos($datos_final);	
	}
}
//comportamiento si va seleccionar la opcion de la noticia en el home
/*if(isset($_POST['home']))
{
	extract($_POST);
	//elimino la que esta actualmente en el home
	$query_elimino_home	=	$db->Execute(sprintf("UPDATE principal SET promocion=0 WHERE id_padre=%s",$id));
	//pongo la nueva noticia como destacada del home
	$query_nueva_home	=	$db->Execute(sprintf("UPDATE principal SET promocion=1 WHERE id=%s",$opcion_home));
	//si se realiza el query
	if($query_nueva_home)
	{
		echo "<script>alert('Se ha agregado el contenido como destacado del home');document.location='index.php?id=".$id."'</script>";
	}
	else
	{
		echo "<script>alert('No se agrego el contenido al home');document.location='index.php?id=".$id."'</script>";
	}
}*/

if(isset($_POST['home']))
{
	extract($_POST);
	//elimino la que esta actualmente en el home
	//$query_elimino_home	=	$db->Execute(sprintf("UPDATE principal SET promocion=0 WHERE id_padre=%s",$id));
	//pongo la nueva noticia como destacada del home
	$cantidades	=	count($opcion_home);
	$contadorCant	=	0;
	foreach($opcion_home as $opcion)
	{
		$query_nueva_home	=	$db->Execute(sprintf("UPDATE principal SET promocion=1 WHERE id=%s",$opcion));
		$contadorCant++;
	}
	if($cantidades == $contadorCant)
	{
		//si se realiza el query
		if($query_nueva_home)
		{
			echo "<script>alert('Se ha agregado el contenido como destacado del home');document.location='index.php?id=".$id."'</script>";
		}
		else
		{
			echo "<script>alert('No se agrego el contenido al home');document.location='index.php?id=".$id."'</script>";
		}
	}
}
if(isset($_GET['borr']))
{
	$query_elimino_home	=	$db->Execute(sprintf("UPDATE principal SET promocion=0 WHERE id=%s",$_GET['borr']));
	echo "<script>alert('Este contenido de ha eliminado del home');document.location='index.php?id=".$id."'</script>";
}
$tabla	 =	'
<div >
<table align="center" width="100%" border="0" class="tablawidth nowitable table" cellpadding="2" id="tabla" cellspacing="0">
					<tbody>
						<tr>
							<td colspan="7" align="center"><b>'.strtoupper($info[0]['titulo']).' ('.$info[0]['id'].')</b></td>
						</tr>
						<tr class="center">
							<td colspan="5">
								P&aacute;ginas: ';
 
								if(!$_GET['ver'])
								{
									$links	 = $paging->fetchNavegacion();
									$tabla	.= $links;
								}
$tabla	.=	'</td>
			<td colspan="2">
				<b>Registros: </b>';
$tabla	.=	$paging->numTotalRegistros();
/*
$tabla	.=	'</td>
			</tr>';

			if($tipo_contenido	==	_TIPO_PRODUCTO or $tipo_contenido == 21)
			{
				$tabla	.='<tr>
						<td colspan="9" align="right">
							<!--<div style="float:left;width:500px">
								<form method="post">
										<div style="float:left;">
											<input type="hidden" id="valor" name="valor">
											<select id="opciones0" name="opciones0" onchange="cargarSelect2(this.value,0)">
												<option value="0">Categorias</option>';
												foreach($listado_catalogo as $info)
												{
													$tabla .='<option value="'.$info['id'].'">'.$info['titulo'].'</option>';
												}
											$tabla.='</select>
										</div>
										<div id="opciones1" name="opciones1" style="float:left">
											<select>
												<option>Subcategoria</option>
											</select>
										</div>
										<div id="opciones2" name="opciones2" style="float:left">
											<select>
												<option>Linea</option>
											</select>
										</div>
										<div style="float:left"><input type="submit" value="Buscar" name="buscar2"></div>
								</form>	
							</div>-->
							<!--<div style="float:left">	
								<form method="post">
										Escriba su busqueda<input type="text" name="texto"><input type="submit" value="Buscar" name="buscar">
								</form>
							</div>-->
					   </td></tr>';
			}	*/
				$tabla.='<tr><td colspan="5">';
$tabla .= '</td>
				<td align="center" colspan="4">';
					
						$tabla.='<b><a href="?id='.$id.'&nueva='.$id.'&type='.$tipo_contenido.'" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a></b>';	
					
					
				$tabla	.='</td>
			</tr>
						
						<form name="form" method="post" action="">
						<tr class="center">';
							if($tipo_contenido == 10)
							{
								$tabla.='<td width="350px" align="left"><b>TITULO</b></td>';
							}
							else
							{
								$tabla.='<td align="left"><b>TITULO</b></td>';
							}
							/*if($tipo_contenido == 10)
							{
								$tabla .=	'<td width="350px" align="center"><b>RELACION</b></td>';
							}*/								
							if($tipo_contenido == 10)
							{
								$tabla .=	/*'<td align="center"><b>CODIGO</b></td>'*/ '';
							}
							else
							{
								$tabla.='<td align="center"><b>ORDENAR</b></td>';
							}	
							
							$tabla.='<td align="center"><b>VISIBLE</b></td>';
															
							if($tipo_contenido == 10)
							{
								/*$tabla .=	'<td align="center"><b>RESE&Ntilde;AS</b></td>';
								$tabla	.='	<td colspan="3" align="center"><b>ACCIONES</b></td>';*/
								$tabla .='<td colspan="2" align="center"><b>VISTA PREVIA</b></td>';
								$tabla .='<td  align="center"><b>ACCIONES</b></td>';
							}
							else
							{
								if($tipo_contenido == 3 or  $tipo_contenido == 0 or $tipo_contenido == 5 or $tipo_contenido == 6 or $tipo_contenido == 1  or $tipo_contenido == 40  or $tipo_contenido == 41  or $tipo_contenido == 42  or $tipo_contenido == 43)
								{
									$tabla	.=	'<td align="center"><b>SUBCONTENIDOS</b></td>';
								}
								elseif($tipo_contenido == 8)
								{
									$tabla.='<td align="center"></td>';
								}
								elseif($tipo_contenido == '')
								{
									$tabla.='<td align="center">RESEÑAS</td>';
								}
								elseif($tipo_contenido == 25 and $id != 12)////@todo tener mucho ojo con esto. si es categoria de tiendas
								{
									$tabla.='<td align="center"><b>SUBCONTENIDOS</b></td>';
									//$tabla.='<td colspan="2" align="center"><b>ACCIONES</b></td>';
								}
								elseif($tipo_contenido == 27 and $id != 15)////@todo tener mucho ojo con esto. si es categoria de vacantes
								{
									$tabla.='<td align="center"><b>SUBCONTENIDOS</b></td>';
									$tabla.='<td align="center"><b>ACCIONES</b></td>';
								}
								elseif($tipo_contenido == 35)
								{
									$tabla.='<td align="center"><b>ASIGNA VACANTES</b></td>';
								}
								else
								{
									$tabla.='<td align="center"><b>SUBCONTENIDOS</b></td>';
								}
							}
							if($tipo_contenido == 17 or  $tipo_contenido == 54)//esto es para poner noticia en el home
							{
								$tabla.='<td align="center"><b>HOME</b></td>';
							}
							$tabla.='<td align="center"><b>M</b></td>';
							
							
							$tabla.='<td align="center"><b><input type="checkbox" onClick="marcar(this)"></b>
									<span class="glyphicon glyphicon-trash"></span>
							</td>
						</tr>';
						$contador	=	1;
						while($rew = $paging->fetchResultado())
						{
								//$dato	=	$funciones->retornaMigaProducto($rew['id']);
								
								$tabla .= '<tr class="center">';
								$tabla.='<td align="left">'.
												utf8_encode($rew['titulo']).'('.$rew['orden'].')
											</td>';
								
								if($tipo_contenido == 10)
								{
									$tabla.= /*'<td align="center">
												'.$rew['codproducto'].'
											</td>'*/'';
								}
								else
								{	
								$tabla.= '<td align="center">';
								if($contador!=1)
								{
									$tabla.= '<a href="?id='.$id.'&id_orden='.$rew['id'].'&orden='.$rew['orden'].'&acc=s" title="Subir contenido"><span class="glyphicon glyphicon-arrow-up"></span> Subir</a>  ';
								}
								if($contador != $paging->numTotalRegistros())
								{ 
									$tabla.= '<a href="?id='.$id.'&id_orden='.$rew['id'].'&orden='.$rew['orden'].'&acc=b" title="Bajar contenido"><span class="glyphicon glyphicon-arrow-down"></span> Bajar</a>';
								}	
									$tabla.= '</td>';
								}
								//para poner el ojito abierto o cerrado
								if($rew['visible'] == 1)//abierto
								{
									$tabla.='<td align="center">
												<span class="glyphicon glyphicon-eye-open"></span>
											</td>';
								}
								else
								{
									$tabla.='<td align="center">
												<span class=" glyphicon glyphicon-eye-close"></span>
											</td>';
								}	
								if($tipo_contenido == 9)
								{				
									$tabla	.='	<td>
													
												</td>';		
								}
								elseif($tipo_contenido == 10)
								{				
									/*$tabla	.='	<td align="center">
													<a href="?id='.$rew['id'].'" title="Ver Rese&ntilde;as">
														<img src="images/iconos/ver-resenias.gif" border="0" title="Ver Rese&ntilde;as">
													</a>
												</td>';		
									
									$tabla	.='	<td align="center">
													<a href="?id=382&padre='.$rew['id'].'&tipo=1" title="Agregar Accesorios">
														<img src="images/iconos/agregar-accesorios.gif" border="0" title="Agregar accesorios">
													</a>
												</td>';
									$tabla	.='	<td align="center">
													<a href="?id=382&padre='.$rew['id'].'&tipo=2" title="Agregar Descargas">
														<img src="images/iconos/agregar-descargas.gif" border="0" title="Agregar Descargas">
													</a>
												</td>';
									$tabla	.='	<td align="center">
													<a href="?id=382&padre='.$rew['id'].'&tipo=6" title="Productos Relacionados">
														Productos Relacionados
													</a>
												</td>';	*/
									$tabla .='<td align="center" colspan="2">
													<a href="appadmin/ver_video.php?video='.$rew['id'].'" title="'.$rew['titulo'].'" rel="Shadowbox;width=410px;height=310px">
														Ver Video
													</a>
												</td>';
									$tabla .='<td align="center">
													<a href="appadmin/ver_comentarios.php?id='.$rew['id'].'" title="Comentarios"  rel="Shadowbox;width=700px;height=500px">
														Ver Comentarios
													</a>
												</td>';
								}
						
								elseif($tipo_contenido == 27 and $id != 15)//@todo tener mucho ojo con esto. si es categoria academias
								{				
									$tabla	.='	<td align="center">
													<a href="?id='.$rew['id'].'" title="Ver Subcontenidos">
														<span class="glyphicon glyphicon-th-list"></span>
													</a>
												</td>';	
									$tabla	.='	<td align="center">
													<a href="?id=382&padre='.$rew['id'].'&tipo=4" title="Agregar Eventos">
														<img src="images/iconos/agregar-eventos.gif" border="0" title="Agregar Eventos">
													</a>
												</td>';		
								}
								elseif($tipo_contenido == 35)
								{
									$tabla	.='	<td align="center">
													<a href="?id=382&padre='.$rew['id'].'&tipo=7&volver='.$id.'" title="Asignar Vacantes">
														Asignar Vacantes
													</a>
												</td>';	
								}
								else
								{				
									$tabla	.='	<td align="center">
													<a href="?id='.$rew['id'].'" title="Ver Subcontenidos">
														<span class="glyphicon glyphicon-th-list"></span>
													</a>
												</td>';		
								}
								if($tipo_contenido == 17 or $tipo_contenido == 54)//esto es para poner la noticia en el home
								{
									$tabla	.=	'<td align="center">';
									if($rew['promocion'] == 1)//seleccionado
									{
										$tabla	.=	'<input type="checkbox" name="opcion_home[]" value="'.$rew['id'].'" checked> <a href="index.php?id='.$id.'&borr='.$rew['id'].'" style="font-size:0.7em">Quitar del Home</a>';
									}
									else
									{
										$tabla	.=	'<input type="checkbox" name="opcion_home[]" value="'.$rew['id'].'">';
									}
									//if($tipo_contenido == _TIPO_PRODUCTO)
								//	{
									//	$tabla	.=	'<a href="?id='.$rew['id'].'&editar='.$rew['id'].'&atrib=1" title="Asignar Atributos"><img src="images/bot-atributos.gif" border="0"></a>';		
									//}
									$tabla	.='</td>';
								}
								//funcionamiento para el producto
								$tabla	.=	'<td align="center">';
								$tabla	.=	'<a href="?id='.$rew['id'].'&editar='.$rew['id'].'" title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>';
								//if($tipo_contenido == _TIPO_PRODUCTO)
							//	{
								//	$tabla	.=	'<a href="?id='.$rew['id'].'&editar='.$rew['id'].'&atrib=1" title="Asignar Atributos"><img src="images/bot-atributos.gif" border="0"></a>';		
								//}
								$tabla	.='</td>';
								
								
								$tabla	.='	<td align="center">
												<input type="checkbox" name="campos[]" value="'.$rew['id'].'">
											</td>
								</tr></tbody>';
								$contador++;
						}
												
					$tabla	.=	'
									<tr>	
											<td align="center" colspan="2">
											</td>
											<td align="center">
												
											</td>
											<td align="center">
												<input type="submit" value="Visible" name="activar" class="btn btn-primary">
											</td>';
					if($tipo_contenido == 17 or $tipo_contenido == 54)//esto es para poner la noticia en el home
					{
						$tabla.='<td align="center"><input type="submit" value="Poner en Home" name="home"  class="btn btn-primary"></td>';
					}
											echo'<td align="center">
												
											</td>';
											
					$tabla.='<td align="center" colspan="2">';

					$tabla.='<input type="submit" value="Eliminar" name="eliminar"  class="btn btn-primary">';	
					$tabla.='</td>
								</tr>
						</form>
						</tbody>
					</table></div>';

//debo traer las categoria que tiene asignado el producto
$query_asignadas	=	$db->Execute(sprintf("SELECT * FROM principal WHERE id IN(SELECT id_padre FROM relacion_contenidos WHERE id=%s)",$id));
//arreglo con la informacion
$info_categorias	=	array();
//recorro el resultado
while(!$query_asignadas->EOF)
{
	array_push($info_categorias,$query_asignadas->fields);
	$query_asignadas->MoveNext();
}

//relacion de usuario
$queryRelUsuarios	=	sprintf("SELECT * FROM usuarios WHERE perfil=2 AND eliminado=0");
$resultUsuarios		=	$db->GetAll($queryRelUsuarios);
//recorro para validar si ya esta relacionado con el id
$salidaUsuarios		=	array();
foreach($resultUsuarios as $relUsers)
{
	//verifico si el usuario está relacionado
	$queryVerific	=	sprintf("SELECT * FROM rel_usuario_producto WHERE idusuario=%s AND id=%s",$relUsers['idusuario'],$id);
	$resultVerifi	=	$db->GetAll($queryVerific);
	$verificacionRel=	(count($resultVerifi) > 0)?1:0;
	$dataSalida1	=	array("usuario"=>$relUsers['nombres']." ".$relUsers['apellidos'],
							  "idusuario"=>$relUsers['idusuario'],
							  "verifica"=>$verificacionRel);
	array_push($salidaUsuarios,$dataSalida1);
}
//traigo los atributos del producto que esta en este momento siendo visiado
$query_atributos	=	$db->Execute(sprintf("SELECT * FROM atributos WHERE producto=%s",$id));
$atributos			=	array();
//recorro la info
while(!$query_atributos->EOF)
{
	array_push($atributos,$query_atributos->fields);
	$query_atributos->MoveNext();
}
//var_dump($atributos);
//productos relacionados
$query_relacionados	=	$db->Execute(sprintf("SELECT * FROM productos_relacionados AS r , principal AS p WHERE r.id=%s  AND p.id=r.id_padre",$id));
$relacionados			=	array();
//recorro la info
while(!$query_relacionados->EOF)
{
	array_push($relacionados,$query_relacionados->fields);
	$query_relacionados->MoveNext();
}

include(_PLANTILLAS.'interfaz/contenido.html');
?>