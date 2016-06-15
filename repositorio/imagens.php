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
	}
	else
	{
		$rut = "?dir=".$reco['ruta']."/&caja=".$_SESSION['caja'];
	}
	$pintado .=  '<div class="media" style="margin:0 0 3% 0">';
	$pintado .= "<a href='".$rut."' onClick='document.form1.ruta.value=\"".$dir."\"' class='pull-left'>";
	$pintado .= '<img width="100%" class="thumnail" style="float:left" src="../externos/Thumb.php?img=../repositorio/carpeta.jpg&tamano=100" title="'.$archivo.'" border="0" title="'.$archivo.'"></a>
			<div class="media-body">
		    	<h4 class="media-heading">'.$reco['nombre'].'</h4>
		    	<!--<button class="btn btn-primary btn-sm">Entrar</button>-->
		    </div>
		  ';
	$pintado .=  '</div>';


}
foreach($archivos as $reco2) 
{
	$ruta_final = str_replace('../images/','',$dir);
	$pintado .=  '<div class="media" style="margin:0 0 3% 0">';
	$pintado .= "<a href='#' onclick='poner(\"".$ruta_final.$reco2['nombre']."\",\"".$_SESSION['caja'] ."\")' class='pull-left'>";
	$pintado .= '<img width="100%" class="thumnail" style="float:left" src="../externos/Thumb.php?img='.$reco2['ruta'].'&tamano=100" >
	</a>
			<div class="media-body">
		   		<h4 class="media-heading" >'.$reco2['nombre'].'</h4>';
		   		/*$pintado  .= "<button style='margin:0 3% 0 0' class='btn btn-primary btn-sm' onclick='poner(\"".$ruta_final.$reco2['nombre']."\",\"".$_SESSION['caja'] ."\")' class='pull-left'>Agregar</button>";*/
		   		$pintado .="<button onClick='borrar_archivo(\"".$reco2['nombre']."\",\"".$dir."\")' class='btn btn-danger btn-sm'>Borrar</button>
		   </div>";
	$pintado .=  '</div>';
}
$pintado .= '</div>';

echo $pintado;
	    /*$contador++;
		//echo "<td><a href='#' onclick='window.opener.document.admin.caja_imagen.value=\"".$archivo."\"'>"; 
		echo "<div class='col-sm-12 col-xs-12 col-md-2 col-lg-2'>"; 
		//echo "<img src='../diseno/images/".$archivo."' title='".$archivo."' width='100' height='100' border='0' title='".$archivo."'>"; 

			if(is_dir($dir.$archivo))
			{
				if($archivo == '..')
				{
					echo "<a href='?dir=".$dir.$archivo."/&caja=".$_SESSION['caja'] ."' onClick='document.form1.ruta.value=\"".$dir."\"'>";
					echo "<img src='../externos/Thumb.php?img=../repositorio/volver.jpg&tamano=100' title='Regresar' border='0' title='Regresar'>"; 
					echo "<br>".$archivo;
					//echo "<a href='?dir=../diseno/images/".$archivo."'><img src='repositorio/cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
					echo "</a>";
				}
				elseif($archivo == '.')
				{
					
				}
			
				elseif($archivo == 'diseno')
				{
					
				}
				else
				{
					echo "<a href='?dir=".$dir.$archivo."/&caja=".$_SESSION['caja'] ."' onClick='document.form1.ruta.value=\"".$dir."\"'>";
					echo "<img src='../externos/Thumb.php?img=../repositorio/carpeta.jpg&tamano=100' title='".$archivo."' border='0' title='".$archivo."'>"; 
					echo "<br>".$archivo;
					echo "<a href='#' onClick='borrar_folder(\"".$archivo."\",\"".$dir."\")'><img src='cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
					echo "</a>";
				}
			}
			else
			{
				//reemplazo la ruta completa por solo la carpeta
				$ruta_final = str_replace('../images/','',$dir);
				//creo el link
				echo "<a href='#' onclick='poner(\"".$ruta_final.$archivo."\",\"".$_SESSION['caja'] ."\")'>";
				echo "<img src='../externos/Thumb.php?img=".$dir.$archivo."&tamano=100' title='".$archivo."' border='1' title='".$archivo."' >"; 
				echo "<br>".substr($archivo,0,-4);
				echo "<a href='#' onClick='borrar_archivo(\"".$archivo."\",\"".$dir."\")'><img src='cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
				echo "</a>";
			}
			echo "</div>";
		  
			if($contador==6)
			{ 
				echo "</div><div class='row'>";
				$contador=0;
			}*/

echo "</div>";


closedir($directorio);
?>
