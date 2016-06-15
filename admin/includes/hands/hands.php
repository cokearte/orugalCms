<script type="text/javascript" src="js/guardado.js"></script>
<script>
//funcion que controla las estrellas
function cargarEstrellas(valor,estrella)
{
	/*
	*	estrella = 1 Significa estrella activa.
	*	estrella = 2 Significa estrella inactiva.
	*/
	//valido que estrella se debe poner si es la 1 pondre la estrella activa de lo contrario sera la inactiva
	ruta_estrella	=(estrella==1)?'php/star/star_act.gif':'php/star/star_inact.gif';
	//pone la estrellita correspondiente sobre la estrella que selecciono
	document.getElementById(valor).src=ruta_estrella;
	//recorre el numero de la estrella seleccionada hacia atras
	for(a=1;a<=valor-1;a++)
	{
		//dentro del recorrido va seleccionando las estrellas enteriores a la actual y les pone la estrella correspondiente
		document.getElementById(a).src=ruta_estrella;
	}
}

</script>

<?
/*
*	La cantidad de estrellas lo decidira la constante que crea el portal pormedio de la condiguracion del home.
*/
global $cont;
global $db;
$numero_estrellas	=	_CANT_ESTRELLAS_DB;//este parametro se configurara desde la configuracion del home
//debo consultar la calificacion del contenido actual para sacar el promedio.
$tabla			=	'principal';
$campo			=	'id';
$campo_voto		=	'calificacion';
$campo_cantidad	=	'cant_votos';

$query		=	sprintf("SELECT * FROM %s WHERE %s=%s",$tabla,$campo,$cont);
$resultado	=	$db->Execute($query);
//divido el puntaje por la cantidad de votos
if($resultado->fields[$campo_cantidad] != '')
{
	$promedio_votos	=	$resultado->fields[$campo_voto]	/ $resultado->fields[$campo_cantidad];
}

echo '<div id="stars">';

echo "<table width='100%'><tr><td>";
echo "<span>"._LBL_CALIFICACION."</span>";
//recorro el numero de estrellas a mostrar para pintar la cantidad especificada
for($a=1;$a<=$numero_estrellas;$a++)
{
	echo '<img src="php/star/star_inact.gif" id="'.$a.'" width="20px" height="20px" onmouseover="cargarEstrellas('.$a.',1)" onclick="calificar('.$a.','.$cont.')" onmouseout="cargarEstrellas('.$a.',2)" title="'.$a.'">';	
}
echo "</td>";
echo "<td style='border-left:1px solid #ccc'>";
echo " <span>"._LBL_PROMEDIO."<span> ".number_format($promedio_votos,1)." ";
for($a=1;$a<=$numero_estrellas;$a++)
{
	for($i=1;$i<=round($promedio_votos);$i++)
	{
		if($a == $i)
		{
			echo '<img src="php/star/star_act.gif" id="'.$a.'" width="20px" height="20px"  title="'.$a.'">';	
		}

	}
	//echo '<img src="php/star/star_inact.gif" id="'.$a.'" width="20px" height="20px"  title="'.$a.'">';	
	
}
echo "</td>";
echo "<td style='border-left:1px solid #ccc'>";
echo " <span>"._LBL_PUNTAJE."<span> ".$resultado->fields[$campo_voto];

echo "</td>";
echo "</tr>";
echo "</table>";
echo '</div>';

echo '<div class="puntaje">';
echo '</div>';


echo '</div>';
//para calcular el promedio de votos la formula esta en dividir el puntaje de la calificaion con la cantidad de votos.



?>




