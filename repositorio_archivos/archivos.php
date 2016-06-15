<style>
	a{
		text-decoration:none;
	}
	#archivos{width:700px;height:400px;overflow-y:scroll;overflow:-moz-scrollbars-vertical;background:#fff;color:#000}
</style>
<script>
	function borrar_archivo(archivo)
	{
		if(confirm("Esta seguro que desea borrar el archivo " + archivo) == true)
		{
			window.location	="carga.php?archivo="+archivo;
		}
		else
		{
			return true;
		}
	}
</script>
<?


$directorio = opendir("../archivos/");
echo "<br><br>";
echo "<div id='archivos'>";
echo "<table border='0' cellspacing='0' style='border:1px solid #000;width:100%'>"; 
		echo "<tr style='background:#000;color:#fff;font-weight:bold;text-align:center'>
					<td>
						TIPO
					</td>	
					<td>
						NOMBRE ARCHIVO
					</td>
					<td>
						ACCIONES
					</td>
			 </tr>";
$contador=0;
while ($archivo = readdir($directorio))
{ 
	$extencion	= substr($archivo,-3);
  	if($archivo == '.' or $archivo == '..' or $archivo == 'Thumbs.db')
   	{
   			
   	}
   	else
   	{
		
	    $contador++;
		
		
		if($extencion == 'txt')//txt
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/txt.gif' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		 }
		 
		elseif($extencion == 'doc')//word
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/doc.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		 }
		 
		elseif($extencion == 'ocx')//word 2007
		{
		echo "<tr>
				<td>
					<img src='tipos_mime/docx.jpg' title='".$archivo."' border='0' title='".$archivo."'>
				</td>	
				<td>
					".$archivo."
				</td>
				<td>
					<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
					<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
					<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
				</td>
		 </tr>";
		}
		elseif($extencion == 'xls')//excel
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/xls.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'lsx')//excel 2007
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/xlsx.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'ppt')//power point
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/ppt.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'ptx')//power point 2007
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/pptx.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'pps')//powerpoint ejecutable
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/pps.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'html')//pagina web html
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/html.gif' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'pdf')//archivo pdf
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/pdf.gif' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'jpg')//imagen jpg
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/jpg.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'JPG')//imagen jpg
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/jpg.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'gif')//imagen gif
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/gif.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'GIF')//imagen gif
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/gif.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'tif')//imagen tif
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/tif.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'png')//imagen png
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/png.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'PNG')//imagen png
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/png.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'fla')//archivo flash
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/fla.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'swf')//archivo swf
		{
			echo "<tr>
					<td>
						<img src='tipos_mime/swf.jpg' title='".$archivo."' border='0' title='".$archivo."'>
					</td>	
					<td>
						".$archivo."
					</td>
					<td>
						<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
						<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
						<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
					</td>
			 </tr>";
		}
		elseif($extencion == 'mp3')//archivo swf
		{
		echo "<tr>
				<td>
					<img src='tipos_mime/multimedia.jpg' title='".$archivo."' border='0' title='".$archivo."'>
				</td>	
				<td>
					".$archivo."
				</td>
				<td>
					<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
					<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
					<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
				</td>
		 </tr>";
		}
		else
		{
			echo "<tr>
				<td>
					<img src='tipos_mime/desconocido.gif' title='".$archivo."' border='0' title='".$archivo."'>
				</td>	
				<td>
					".$archivo."
				</td>
				<td>
					<a href='#' onClick='borrar_archivo(\"".$archivo."\")'><img src='cancel.gif' border='0'> Eliminar</a>
					<a href='archivos/".$archivo."' target='_black'><img src='ver.png' border='0'> Abrir</a>
					<a href='#' onclick='window.opener.document.form.adjunto.value=\"".$archivo."\"'><img src='incluir.png' border='0' width='20px' height='20px'>Incluir</a>
				</td>
		 </tr>";
		}

   	}
	
}
echo "</table>";
echo "</div>";
closedir($directorio);
?>
