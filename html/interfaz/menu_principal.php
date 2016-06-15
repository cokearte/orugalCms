<?php
	global $core;
	global $id;
	$opciones_secundario = $core->listarMenuPrincipal();
	$queryNoticias		 = $db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre=10 AND eliminado=0 ORDER BY id ASC limit 1"));	
	$contador	=	0;
	echo"<li>";	
						echo"<a title='".$datos['titulo']."' href='#home'>
								Inicio
							</a>";
					 echo"</li>";
	foreach($opciones_secundario as $datos)
	{
		$clase	=	($datos['id'] == $id)?'opcionesMenuSel':'';
		if($datos['id'] == 13)
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='#quienesSomos'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}
		elseif($datos['id'] == 1190)
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='#menu'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}
		elseif($datos['id'] == 1195)
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='#galeria'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}
		elseif($datos['id'] == 1199)
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='#reservacion'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}
		elseif($datos['id'] == 1203)
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='#contacto'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}
		else
		{
			echo"<li>";	
				echo"<a title='".$datos['titulo']."' href='"._DOMINIO."index.php?id=".$datos['id']."'>
						".$datos['titulo']."
					</a>";
			echo"</li>";
		}	

		$contador++;	
	}
?>