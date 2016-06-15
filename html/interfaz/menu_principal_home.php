<?
	global $core;
	$opciones_secundario = $core->listarMenuPrincipal();
	$contador	=	0;
	foreach($opciones_secundario as $datos)
	{
		echo"<li>";
				if($datos['id'] == 13)
				{
					echo"<a  href='index.php?id=1158'>
							".$datos['titulo']."
						</a>";
				}
				elseif($datos['id'] == 14)
				{
					echo"<a  href='index.php?id=1161'>
							".$datos['titulo']."
						</a>";
				}
				else
				{
					echo "<a href='index.php?id=".$datos['id']."'>
						".$datos['titulo']."
					</a>";
				}
		echo "</li>";
		$contador++;	
	}
?>