<div id="memoria">
<?
global $id;
$anoInicial = '2011';
$anoFinal = '2100';
$funcionTratarFecha = 'document.location = "?id='.$id.'&dia="+dia+"&mes="+mes+"&ano="+ano;';
?><script>
function tratarFecha(dia,mes,ano){
  <?=$funcionTratarFecha?>
}
</script>
<style>
.m1 {
   font-family:MS Sans Serif;
   font-size:8pt
}
a {
   text-decoration:none;
   color:#000000;
}
select{padding:3px;}
.tarea{width:220px;position:absolute;z-index:50;display:none;margin:0;background:#333}
.contBot{width:200px;float:left;padding:10px}
.bot{padding:3px;border:1px dotted #CCC;float:left;margin:0 0 0 3px;}
.cajaTarea{border:1px solid #CCC;width:200px;height:50px;float:left}
.nuevo{width:236px;padding:10px;background:#d4d0c8;float:left;border-bottom:1px dotted #333}
.fecha{width:236px;font-size:12px;text-align:left;float:left;color:#c19e4c;}
.texto{width:236px;float:left}
#datos{width:256px;background:#d4d0c8;}
#datos h1{font-size:20px;padding:0 0 0 10px;margin:0;color:#333}
</style>
<script src="jquery.min.js"></script>
<script>
	$(document).ready(
		function ()
		{
			
		}
	);
</script>
<table border="0" cellpadding="5" cellspacing="0" bgcolor="#D4D0C8" width="600px" align="center">
  <tr>
    <td width="100%" >
<?
$fecha = getdate(time());
if(isset($_GET["dia"]))$dia = $_GET["dia"];
else $dia = $fecha['mday'];
if(isset($_GET["mes"]))$mes = $_GET["mes"];
else $mes = $fecha['mon'];
if(isset($_GET["ano"]))$ano = $_GET["ano"];
else $ano = $fecha['year'];
$fecha = mktime(0,0,0,$mes,$dia,$ano);
$fechaInicioMes = mktime(0,0,0,$mes,1,$ano);
$fechaInicioMes = date("w",$fechaInicioMes);
?>
    <select size="1" name="mes" class="m1" onchange="document.location = '?dia=<?=$dia?>&mes=' + document.forms[0].mes.value + '&ano=<?=$ano?>';">
<?
$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
for($i = 1; $i <= 12; $i++){
  echo '      <option ';
  if($mes == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$meses[$i-1]."\n";
}
?>
    </select>&nbsp;&nbsp;&nbsp;<select size="1" name="ano" class="m1" onchange="document.location = '?dia=<?=$dia?>&mes=<?=$mes?>&ano=' + document.forms[0].ano.value;">
<?
for ($i = $anoInicial; $i <= $anoFinal; $i++){
  echo '      <option ';
  if($ano == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$i."\n";
}
?>
    </select><br>
    <font size="1">&nbsp;</font><table border="0" cellpadding="2" cellspacing="0" width="100%" class="m1" bgcolor="#FFFFFF" height="100%">
<?
$diasSem = Array ('L','M','M','J','V','S','D');
$ultimoDia = date('t',$fecha);
$numMes = 0;
for ($fila = 0; $fila < 7; $fila++){
  echo "      <tr>\n";
  for ($coln = 0; $coln < 7; $coln++){
    $posicion = Array (1,2,3,4,5,6,0);
    echo '        <td valign="top" style="padding:30px;color:#FFF;font-size:1.2em"';
    if($fila == 0)echo ' bgcolor="#333"';
    if($dia-1 == $numMes)echo ' bgcolor="#ff9900"';
    echo " align=\"right\">\n";
    echo '        ';
    if($fila == 0)echo '<font color="#D4D0C8">'.$diasSem[$coln];
    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){
    	$sumado	=	++$numMes;
      echo '<a class="link" id="'.$sumado.'" onclick="tratarFecha('.$sumado.','.$mes.','.$ano.')">';
      if($dia == $numMes)echo '<font color="#333"><b>';
      echo ($numMes).'</b></a><!--<div id="div'.$numMes.'" class="tarea">
      							<div class="contBot">
      								<textarea id="texto'.$numMes.'" class="cajaTarea"></textarea>
      							</div>
      							<div class="contBot">
      								<input type="button" value="Guardar" onclick="guardar('.$numMes.','.$mes.','.$ano.')" class="bot" />
      								<input type="button" value="Cancelar" onclick="quitar('.$numMes.')" class="bot" />
      							</div>
      						  </div>-->';
    }
    echo "</td>\n";
  }
  echo "      </tr>\n";
}
?>
    </table>
    </td>
  </tr>
</table>
</div>