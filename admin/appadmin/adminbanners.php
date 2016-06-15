<div>
<?
/*
 * Administracion de Banners Oikos Storage
 * @autor Farez Jair Prieto Castro
 * @date 19 Mayo de 2010
 */
global $db;
global $id;
global $funciones;
$bandera	=	false;
if(isset($_GET['edit']))
{
	$bandera	=	true;
	$lista_banners	=	$funciones->consultaUniversal('banners','eliminado=0 AND id_banner='.$_GET['edit'],'*');
	//valido si se dio la orden de guardar
	if(isset($_POST['enviar']))
	{
		$tamano 		= $_FILES["archivo"]['size'];// tamaño
	    $tipo 			= $_FILES["archivo"]['type'];//tipo
	    $archivo		= $_FILES["archivo"]['name'];//nombre
	    $destino 		= "../banners/".$archivo;
	    //valido que sea un SWF valido
	    //valido si viene si no ha seleccionado un archivo
	    if(!empty($archivo))
	    {
		    if($tipo == 'application/x-shockwave-flash')
		    { 
			    if(copy($_FILES['archivo']['tmp_name'],$destino))
				{ 
					//ahora actualiza la base de datos
					$query_actualiza	=	$db->Execute(sprintf("UPDATE banners SET banner='%s' WHERE id_banner=%s",$archivo,$_GET['edit']));
					if($query_actualiza)
					{
						echo "<script>alert('El banner ha sido actualizado');document.location='index.php?id=323'</script>";
					}
					else
					{
						echo "<script>alert('No se pudo actualizar el banner')</script>";
					}
				}
				else
				{
					echo "<script>alert('El archivo no fue subido')</script>";
				}
		    }
		    else
		    {
		    	echo "<script>alert('Recuerde que solo son permitidos archivos de tipo SWF (Animacion de Flash)')</script>";
		    }
	    }
	    else
	    {
	    	echo "<script>alert('Primero seleccione el archivo a cargar')</script>";
	    }
	}
}
else
{
	//consulto los banners que esten cargados en este momento
	$lista_banners	=	$funciones->consultaUniversal('banners','eliminado=0','*');
}

?>
<?if($bandera	== false){ ?>
<table width="100%" border="1">
	<tr>
		<td align="center">
			<b>Banner Actual</b>
		</td>
		<td align="center">
			<b>Acciones</b>
		</td>
	</tr>
	<?
		foreach($lista_banners as $banners)
		{
			echo '<tr>
					<td align="left">
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="418" height="94">
						  <param name="movie" value="../banners/'.$banners['banner'].'" />
						  <param name="quality" value="high" />
						  <embed src="../banners/'.$banners['banner'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="418" height="94"></embed>
						</object>
					</td>
					<td align="center">
						<a href="index.php?id='.$id.'&edit='.$banners['id_banner'].'"><img src="images/edit.gif"></a>
					</td>
				</tr>';
		}
	?>	
</table>
<?}else{ ?>
<form method="post" enctype="multipart/form-data">
	<table border="1">
		<tr>
			<td>
				<b>Banner Actual</b>
			</td>
			<td align="center">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="418" height="94">
				  <param name="movie" value="../banners/<?=$lista_banners[0]['banner']?>" />
				  <param name="quality" value="high" />
				  <embed src="../banners/<?=$lista_banners[0]['banner']?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="418" height="94"></embed>
				</object>
				<input type="hidden" name="actual" value="<?=$lista_banners[0]['banner']?>">
			</td>
		</tr>
		<tr>
			<td>
				<b>Cargar Banner Nuevo</b>
			</td>
			<td align="center">
				<input type="file" name="archivo">
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" name="enviar" value="Guardar">
			</td>
		</tr>
	</table>
</form>
<?} ?>