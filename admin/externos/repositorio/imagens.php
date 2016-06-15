<style>
	a{
		text-decoration:none;
	}
	#imagenes{width:950px;height:350px;overflow-y:scroll;overflow:-moz-scrollbars-vertical;background:#fff;color:#000}
	.tabla{background:#fff;width:100%}
	.tabla tr{border:1px solid red}
</style>
<script>
function poner(dato)
{
	window.opener.document.admin.caja_imagen.value=dato;
	window.opener.mostrar(dato);
	
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
$dir	=	(isset($_GET['dir']))?$_GET['dir']:'../../../images/';
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
					echo "<a href='?dir=".$dir.$archivo."/' onClick='document.form1.ruta.value=\"".$dir."\"'>";
					echo "<img src='../Thumb.php?img=repositorio/volver.jpg&tamano=100' title='Regresar' border='0' title='Regresar'>"; 
					echo "<br>".$archivo;
					//echo "<a href='?dir=../diseno/images/".$archivo."'><img src='repositorio/cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
					echo "</a>";
				}
				elseif($archivo == '.')
				{
					
				}
				else
				{
					echo "<a href='?dir=".$dir.$archivo."/' onClick='document.form1.ruta.value=\"".$dir."\"'>";
					echo "<img src='../Thumb.php?img=repositorio/carpeta.jpg&tamano=100' title='".$archivo."' border='0' title='".$archivo."'>"; 
					echo "<br>".$archivo;
					echo "<a href='#' onClick='borrar_folder(\"".$archivo."\",\"".$dir."\")'><img src='cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
					echo "</a>";
				}
			}
			else
			{
				//reemplazo la ruta completa por solo la carpeta
				//$ruta_final = str_replace('../../images/','',$dir);
				$dir2	=	(isset($_GET['dir']))?$_GET['dir']:'../images/';
				echo $dir2.$archivo;
				//creo el link
				echo "<a href='#' onclick='poner(\"".$ruta_final.$archivo."\")'>";
				echo "<img src='../Thumb.php?img=".$dir2.$archivo."&tamano=100' title='".$archivo."' border='1' title='".$archivo."' >"; 
				echo "<br>".substr($archivo,0,-4);
				echo "<a href='#' onClick='borrar_archivo(\"".$archivo."\",\"".$dir."\")'><img src='../diseno/cancel.gif' border='0' title='Eliminar ".$archivo."'></a>";
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
