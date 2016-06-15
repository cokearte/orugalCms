<?php
ini_set("display_errors",0);
/*
 * Se maneja la asignacion de la publicidad para las secciones de la pagina
 * @author Farez Prieto
 * @date 11 de Octubre de 2010
 */
global $db;
global $funciones;

$hijos_principal	=	$funciones->obtenerListado(10);
?>
<!-- Call shadowbox scripts //-->
<link rel="stylesheet" type="text/css" href="../shadowbox-3.0.3/shadowbox.css">
<script type="text/javascript" src="../shadowbox-3.0.3/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({
    handleOversize: "drag",
    modal: true
});
</script>
<script type="text/javascript"><!--
	function closeShadow()
	{
		Shadowbox.close();
	}
// --></script>
<style>
	.textos{font-size:0.8em}
	.titulos{font-weight:bold;text-align:center}
</style>
<table style="border:1px solid #999" align="center">
	<tr>
		<td class="textos" colspan="2">
			Esta Zona le permitira agregar o quitar la publicidad para las secciones Principales de la p&aacute;gina web
		</td>
	</tr>
	<tr>
		<td class="titulos">
			SECCION
		</td>
		<td class="titulos">
			ACCIONES
		</td>
	</tr>
	<tr>
		<td class="info">
			Home
		</td>
		<td class="info" align="center">
			<a href="appadmin/publicidad2.php?seccion=1&cantidad=4" rel="Shadowbox; width=600px;height=500px" target="_blank">Editar Publicidad</a> <!-- | <a href="<?=_DOMINIO?>index.php?id=1" target="_blank">Vista Previa</a>-->
		</td>
	</tr>
	<?foreach($hijos_principal as $hijos)
	  {
	  	if($hijos['id'] != 15 and $hijos['id'] != 337)
	  	{
	?>
	<tr>
		<td class="info">
			<?=$hijos['titulo'] ?>
		</td>
		<td class="info" align="center">
			<a href="appadmin/publicidad2.php?seccion=<?=$hijos['id'] ?>&cantidad=<?=$hijos['puntoscanje'] ?>" rel="Shadowbox; width=600px;height=500px" target="_blank">Editar Publicidad</a><!--  | <a href="<?=_DOMINIO?>index.php?id=<?=$hijos['id']?>" target="_blank">Vista Previa</a>-->
		</td>
	</tr>
	<?	
	  	}
	} ?>
	
	<tr>
		<td class="info">
			Vista Previa Video
		</td>
		<td class="info" align="center">
			<a href="appadmin/publicidad2.php?seccion=358&cantidad=3" rel="Shadowbox; width=600px;height=500px" target="_blank">Editar Publicidad</a>
		</td>
	</tr>
</table>
