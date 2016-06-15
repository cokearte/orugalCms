<?
ini_set("display_errors",0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
extract($_GET);
//detecto si es una ipad la que me visita la pagina
$cadena	=	$_SERVER['HTTP_USER_AGENT'];
$var	= strstr($cadena,'iPad');
$banners	=	$funciones->banners(358,3);//carga los banners del home
//aca debo identificar si el video que estan visitando es un video de la zona restrigida
$query_zona	=	$db->GetALL(sprintf("SELECT * FROM principal WHERE id=%s",$id));	
$prom_votos	=	$funciones->obtenerPromedioVotos($id);
//variable que dira si le quitara creditos
$quitar_creditos	=	0;
//traigo los comentarios que esten asignados a este video visitado
$comentarios	=	$db->GetAll(sprintf("SELECT * FROM usuarios as u,principal as p, comentarios as c WHERE c.id=%s AND p.id=c.id AND c.idusuario=u.idusuario",$id));
//var_dump($comentarios);
if($query_zona[0]['promocion'] == 1)//si es de la zona VIP procedo a verificar si hay una session de usuario valida abierta
{
	if(isset($_SESSION['ingreso']))//si la session existe procedo a consultar los videos de la zona VIp que esten relacionados
	{
		//valido si el tipo de descuento es por tiempo o por creditos
		if($query_zona[0]['canje']	==	1)//por tiempo
		{
			//verifico si el usuario ya esta registrado en la base de datos 
			$query_saber_tiempo	=	$db->Execute(sprintf("SELECT * FROM usuarios WHERE idusuario=%s",$_SESSION['ingreso']['idusuario']));
			if($query_saber_tiempo->fields['tiempo'] > 0)//quiere decir que ya tiene tiempo
			{
				//si la fecha que tiene el usuario àra navegar ya expiro debo mostrarle en pantalla de que no tiene tiempo disponible
				if($fec_emision > $query_saber_tiempo->fields['vencimiento'])//si la fecha ya expiro
				{
					$quitar_creditos	=	2;
				}
				else
				{
					//lo dejo ver el video normalito
					$quitar_creditos	=	0;
				}
			}
			else
			{
				$quitar_creditos	=	2;
			}
		}
		elseif($query_zona[0]['canje']	==	0)//por creditos
		{
				//esta pedazo del codigo generara una fecha de venciemiento para el video desde el momentro que activa el gasto de los creditos
				$fec_emision = date("Y-m-d");
				//busco si el usuario esta en la tabla de registro del video y el usuario
				$query_registro	=	$db->Execute(sprintf("SELECT * FROM rel_usuario_producto WHERE idusuario=%s AND id=%s",$_SESSION['ingreso']['idusuario'],$id))or die("paila");
			//valido la cantidad de creditos que se deben tener
			if($_SESSION['ingreso']['creditos'] >= $query_zona[0]['puntoscanje'])
			{
				//en esta parte le permito ver el video
				//habilito una variable que le mostrara que el video que va a ver le quitara creditos
				if($fec_emision > $query_registro->fields['fecha_vencimiento'] AND !isset($_GET['ver']))//en esta parte se debe mostrar la venbtanita de quitar los creditos
				{
					$quitar_creditos	=	1;
				}
				elseif($fec_emision < $query_registro->fields['fecha_vencimiento'] AND !isset($_GET['ver']))
				{
					//en esta parte es cuando el video aun no ha caducado y entra a verlo, espara que se salte la ventana de verificacion
					$quitar_creditos	=	0;
				}
				else//aca debo proceder a descontar los creditos
				{
					//aca debo verificaro si el video ya caduco la fecha que se le dio de actividad
					if($fec_emision > $query_registro->fields['fecha_vencimiento'] AND isset($_GET['ver']))
					{
						$quitar_creditos	=	0;
						//esta pedazo del codigo generara una fecha de venciemiento
						$fec_vencimiento = $funciones->fechaVencimiento($fec_emision,1);
						
						//borro el registro actual
						$query_borrar	=	$db->Execute(sprintf("DELETE FROM rel_usuario_producto WHERE idusuario=%s AND id=%s",$_SESSION['ingreso']['idusuario'],$id));
						
						//inserto el registro en la tabla
						$query_insert_registro	=	$db->Execute(sprintf("INSERT INTO rel_usuario_producto (idusuario,id,fecha_registro,fecha_vencimiento) 
																VALUE('%s','%s','%s','%s')",
																$_SESSION['ingreso']['idusuario'],
																$id,
																$fec_emision,
																$fec_vencimiento));
						//descuento los creditos al usuario
						$query_descuento	=	$db->Execute(sprintf("UPDATE usuarios SET creditos=creditos-%s WHERE idusuario=%s",$query_zona[0]['puntoscanje'],$_SESSION['ingreso']['idusuario']));
					
					//ahora consulto de nuevo el saldo del usuario
						$saldo				=	$db->Execute(sprintf("SELECT * FROM usuarios WHERE idusuario=%s",$_SESSION['ingreso']['idusuario']));
						if($query_descuento)
						{
							//le actualizo los creditos en la session al usuario
							$_SESSION['ingreso']['creditos']	=	$saldo->fields['creditos'];
						}						
					}
					else
					{
						$quitar_creditos	=	0;
					}
				}
			}
			else//no hay acceso al video
			{
				echo "<script>alert('No tiene Suficientes creditos para ver este video');document.location='index.php?id=16'</script>";
			}
		}
		$info_id	=	$core->info_id;
		//aca debo traer los videos relacionados a esta categoria del video visitado.
		$ssql = sprintf("SELECT * FROM principal as p,relacion_contenidos as r WHERE r.id_padre=%s AND p.id=r.id AND p.eliminado=0 AND p.visible=1 AND p.promocion=1 ORDER BY orden ASC",$padre);
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
			$numver=8;
		}
		$paging->porPagina($numver);
		$paging->agregarConsulta($ssql);
		$paging->ejecutar();
		if(!$paging->numTotalRegistros())
		{
			$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
		}
		
		$links = $paging->fetchNavegacion();
		
		//debo actualizar las visitas para el video que se esta viendo
		$actualiza_visitas	=	$db->Execute(sprintf("UPDATE principal SET visitas=visitas+1 WHERE id=%s",$id));
		include(_PLANTILLAS.'interfaz/catalogo_view_vip.html');
	}
	else
	{
		//si no esta la session abierta debe enviarlo al login para que ingrese o en su defecto se registre
		echo "<script>document.location='index.php?id=337&video=".$id."&padre=".$_GET['padre']."&verific=".base64_encode('El video que esta solicitanto es excusivo para usuarios Registrados')."'</script>";
	}
}
elseif($query_zona[0]['novedad'] == 1)
{
	if(isset($_SESSION['ingreso']))//si la session existe procedo a consultar los videos de la zona VIp que esten relacionados
	{
		$info_id	=	$core->info_id;
		//aca debo traer los videos relacionados a esta categoria del video visitado.
		$ssql = sprintf("SELECT * FROM principal as p,relacion_contenidos as r WHERE r.id_padre=%s AND p.id=r.id AND p.eliminado=0 AND p.visible=1 AND p.destacado=1 ORDER BY orden ASC",$padre);
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
			$numver=8;
		}
		$paging->porPagina($numver);
		$paging->agregarConsulta($ssql);
		$paging->ejecutar();
		if(!$paging->numTotalRegistros())
		{
			$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
		}
		
		$links = $paging->fetchNavegacion();
		
		//debo actualizar las visitas para el video que se esta viendo
		$actualiza_visitas	=	$db->Execute(sprintf("UPDATE principal SET visitas=visitas+1 WHERE id=%s",$id));
		include(_PLANTILLAS.'interfaz/catalogo_view.html');
	}
	else
	{
		//si no esta la session abierta debe enviarlo al login para que ingrese o en su defecto se registre
		echo "<script>document.location='index.php?id=337&video=".$id."&padre=".$_GET['padre']."&verific=".base64_encode('El video que esta solicitanto es excusivo para usuarios Registrados')."'</script>";
	}
}
else
{
	$info_id	=	$core->info_id;
	//aca debo traer los videos relacionados a esta categoria del video visitado.
	$ssql = sprintf("SELECT * FROM principal as p,relacion_contenidos as r WHERE r.id_padre=%s AND p.id=r.id AND p.eliminado=0 AND p.visible=1 AND p.tipo_contenido=10 GROUP BY p.id ORDER BY orden ASC",$padre);
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
		$numver=8;
	}
	$paging->porPagina($numver);
	$paging->agregarConsulta($ssql);
	$paging->ejecutar();
	if(!$paging->numTotalRegistros())
	{
		$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
	}
	
	$links = $paging->fetchNavegacion();
	
	//debo actualizar las visitas para el video que se esta viendo
	$actualiza_visitas	=	$db->Execute(sprintf("UPDATE principal SET visitas=visitas+1 WHERE id=%s",$id));
	include(_PLANTILLAS.'interfaz/catalogo_view.html');
}
?>

 