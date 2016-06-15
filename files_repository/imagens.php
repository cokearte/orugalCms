<style>
	a{
		text-decoration:none;
	}
	#imagenes{width:950px;height:350px;background:#fff;color:#000}
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
//capturo el directorio a examinar
$dir	=	(isset($_GET['dir']))?$_GET['dir']:'../archivos/';
//abro el directorio
$directorio = opendir($dir);
echo "<div id='imagenes'>";
echo "<table cellspacing='0' class='tabla'><tr>";
$contador=0;
while ($archivo = readdir($directorio))
{ 
	

	    $contador++;
		//echo "<td><a href='#' onclick='window.opener.document.admin.caja_imagen.value=\"".$archivo."\"'>"; 
		echo "<td width='150px' height='150px' style='border:1px solid #666' align='center'>"; 
		//echo "<img src='../diseno/images/".$archivo."' title='".$archivo."' width='100' height='100' border='0' title='".$archivo."'>"; 

			if(is_dir($dir.$archivo))
			{
				if($archivo == '..')
				{
					echo "<a href='?dir=".$dir.$archivo."/&caja=".$_GET['caja']."' onClick='document.form1.ruta.value=\"".$dir."\"'>";
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
					echo "<a href='?dir=".$dir.$archivo."/&caja=".$_GET['caja']."' onClick='document.form1.ruta.value=\"".$dir."\"'>";
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
				//echo "<a href='#' onclick='poner(\"".$ruta_final.$archivo."\",\"".$_GET['caja']."\")'>";
				echo "<a href='#' style='border:none' onclick='window.opener.document.form.adjunto.value=\"".$ruta_final.$archivo."\"'>";
				//detecto el tipo de archivo para saber que icono poner
				$extencion_icono	=	substr($archivo,-3,3);
				if(strtolower($extencion_icono) == 'flv')
				{
					 echo "<img src='../images/diseno/flv-icono.png' title='".$archivo."' border='1' title='".$archivo."' border='0'>";
				}
				elseif(strtolower($extencion_icono) == 'swf')
				{
					echo "<img src='../images/diseno/flash-icon.jpg' title='".$archivo."' border='1' title='".$archivo."'  border='0'>";	
				}
				elseif(strtolower($extencion_icono) == 'jpg')
				{
					echo "<img src='".$ruta_final.$archivo."' title='".$archivo."' border='1' title='".$archivo."'  border='0' width='101px'>";	
				}
				elseif(strtolower($extencion_icono) == 'png')
				{
					echo "<img src='".$ruta_final.$archivo."' title='".$archivo."' border='1' title='".$archivo."'  border='0' width='101px'>";	
				}
				elseif(strtolower($extencion_icono) == 'gif')
				{
					echo "<img src='".$ruta_final.$archivo."' title='".$archivo."' border='1' title='".$archivo."'  border='0' width='101px'>";	
				}
				else
				{
					echo "<img style='border:none' src='../images/diseno/desconocido.png' title='".$archivo."' border='1' title='".$archivo."'  border='0' width='101px'>";
				}
				
				 
				echo "<br>".substr($archivo,0,-4);
				echo "<a  href='#' onClick='borrar_archivo(\"".$archivo."\",\"".$dir."\")'><img src='cancel.gif'  border='0' title='Eliminar ".$archivo."'></a>";
				echo "</a>";
			}
			echo "</td>";
		  
			if($contador==5)
			{ 
				echo "</tr><tr>";
				$contador=0;
			}



	
}
echo "</tr></table>";
echo "</div>";
closedir($directorio);
?>
