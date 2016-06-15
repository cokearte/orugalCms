<?php 
session_start();
require("../config/configuracion.php");
ini_set("display_errors",0);
if(!isset($_SESSION['login']))
{
	include("rest.php");
}
else
{
?>

<style>
	a{
		text-decoration:none;
	}
	#imagenes{width:990px;height:350px;background:#fff;color:#000;overflow:auto}
	.tabla{background:#fff;width:100%}
	.tabla tr{border:1px solid red}
</style>
<script>
function poner(dato,caja)
{
	if(caja=='imagen')
	{
		window.opener.document.form.imagen.value=dato;	
	}
	else if(caja=='imagen2')
	{
		window.opener.document.form.imagen2.value=dato;	
	}
	else if(caja=='imagen3')
	{
		window.opener.document.form.imagen3.value=dato;	
	}
	else if(caja=='imagen4')
	{
		window.opener.document.form.imagen4.value=dato;	
	}
	else if(caja=='imagen5')
	{
		window.opener.document.form.imagen5.value=dato;	
	}
	window.opener.mostrar(dato,caja);
	window.close();
	
}
</script>
<script>
	function borrar_archivo(archivo,dir)
	{
		if(confirm("Esta seguro que desea borrar el archivo " + archivo) == true)
		{
			window.location	="carga.php?archivo="+archivo+"&dir="+dir;
		}
		else
		{
			return true;
		}
	}
</script>
<?
session_start();
//valido si viene la variable caja
if(isset($_GET['caja']))
{
	$_SESSION['caja'] =	$_GET['caja']; 
}
//capturo el directorio a examinar
$dir	=	(isset($_GET['dir']))?$_GET['dir']:'../images/';
//abro el directorio
$directorio = opendir($dir);

echo "<div class='row'>";
$contador=0;
$carpetas = array();
$archivos = array();
$carpetasRest = array("diseno",".");
$archivosRest = array();
while ($archivo = readdir($directorio))
{ 
	//meto todo en arreglos para saber que es carpetas y que es archivos
	if(is_dir($dir.$archivo))
	{
		if(!in_array($archivo, $carpetasRest))
		{
			$array = array("nombre"=>$archivo,
					   "ruta"=>$dir.$archivo,
					   "tipo"=>"folder");
			array_push($carpetas,$array);
		}
	}
	else
	{
		if(!in_array($archivo, $archivosRest))
		{
			$array2 = array("nombre"=>$archivo,
						    "ruta"=>$dir.$archivo,
						    "tipo"=>"file");
			array_push($archivos,$array2);
		}
	}

}
$pintado =  '';
//count($carpetas);echo "sdsasd";
foreach($carpetas as $reco) 
{

	if($reco['nombre'] == "..")
	{
		$rut = "?dir=".$reco['ruta']."/&caja=".$_SESSION['caja'];
		$classCarpetas = "carpetas";
	}
	else
	{
		$rut = "?dir=".$reco['ruta']."/&caja=".$_SESSION['caja'];
		$classCarpetas = "carpetas";
	}
	$pintado .=  '<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3 text-center" style="margin:0 0 3% 0">';
	$pintado .= '<div class="media-body '.$classCarpetas.'" data-carpeta="'.$reco['ruta'].'" style="float:left;width:100%;text-center"><center>';
	$pintado .= "<a style='float:left' href='".$rut."' onClick='document.form1.ruta.value=\"".$dir."\"' class='pull-left'>";
	$pintado .= '<img width="100%" class="thumnail" style="float:left" src="../externos/Thumb.php?img=../repositorio/carpeta.jpg&tamano=100" title="'.$archivo.'" border="0" title="'.$archivo.'"></a><br>
			
		    	<small><strong>'.ucwords(strtolower($reco['nombre'])).'</strong></small></center>
		    </div>
		  ';
	$pintado .=  '</div>';


}
foreach($archivos as $reco2) 
{
	$ruta_final = str_replace('../images/','',$dir);
	$pintado .=  '<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3 text-center" style="margin:0 0 3% 0">';
	$pintado .= '<div class="media-body imagenes" data-ruta="'.$ruta_final.$reco2['nombre'].'" data-imagen="'.$reco2['nombre'].'"  style="float:left;width:100%;text-center"><center>';
	$pintado .= "<a style='float:left' href='#' class='pull-left'>";
	$pintado .= '<img width="100px" height="100px" class="thumbnail" style="float:left" src="../externos/Thumb.php?img='.$reco2['ruta'].'&tamano=100" >
	</a><br>
		   		<small><strong>'.$reco2['nombre'].'</strong></small> ';
		   		/*$pintado  .= "<button style='margin:0 3% 0 0' class='btn btn-primary btn-sm' onclick='poner(\"".$ruta_final.$reco2['nombre']."\",\"".$_SESSION['caja'] ."\")' class='pull-left'>Agregar</button>";*/
		   		$pintado .="<br>
		   			<button onClick='borrar_archivo(\"".$reco2['nombre']."\",\"".$dir."\")' class='btn btn-danger btn-sm'>Borrar</button>
		   			<button onclick='poner(\"".$ruta_final.$reco2['nombre']."\",\"".$_SESSION['caja'] ."\")' class='btn btn-success btn-sm'>Usar</button>
		   			</center>
		   </div>";
	$pintado .=  '</div>';
}
$pintado .= '</div>';

echo $pintado;


echo "</div>";


closedir($directorio);


}
?>
