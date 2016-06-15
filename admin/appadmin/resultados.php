<?global $db;?>
<script type="text/javascript" src="js/objetoajax.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<form method="post">
<table class="tabla" width="100%">
	<tr>
		<td>Tipo de Juego</td>
		<td>
			<select name="tipo">
				<option value="0" <?if(isset($_POST['tipo']) and $_POST['tipo']==0){echo "selected";} ?>>Sencillo</option>
				<option value="1" <?if(isset($_POST['tipo']) and $_POST['tipo']==1){echo "selected";} ?>>Doble</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Nro Sets</td>
		<td>
			<select name="set">
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="7">7</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" value="Cargar Form" name="cargar">
		</td>
	</tr>
</table>

<?
if(isset($_POST['cargar']) or isset($_POST['guardar']))
{
	//capturo las variables correspondientes
	$tipo_juego	=	$_POST['tipo'];
	$sets		=	$_POST['set'];
	//realizo el proceso para pintar los datos
	if($tipo_juego	==	0)//quiere decir que es sencillo
	{
		//pinto la primera tablita
		$tabla	=	"<table width='100%'>
							<tr>
								<td colspan='2'><b>EQUIPO 1</b></td>
							</tr>
							<tr>
								<td>
									<b>Jugador 1</b>
								</td>
								<td align='left'>
									<input type='text' id='jugador1' name='jugador1' size='30'  autocomplete='off' onkeyup='listaJugadores(1,this.value)'>
									<input type='hidden' id='escon1' name='escon1' size='30'>";
		
		//realizo un for segun la cantidad de sets
		for($a=1;$a<=$sets;$a++)
		{
			$tabla	.=	"<input type='text' size='1' name='combo1[]'><div id='text1' style='width:200px;z-index:250;position:relative;background:#fff;display:none;border:1px solid #000'></div>";
		}
		
		$tabla	.=	"</td>
							</tr>
							<tr>
								<td colspan='2'><b>EQUIPO 2</b></td>
							</tr>
							<tr>
								<td>
									<b>Jugador 2</b>
								</td>
								<td align='left'>
									<input type='text' id='jugador2' name='jugador2' size='30' autocomplete='off' onkeyup='listaJugadores(2,this.value)'>
									<input type='hidden' id='escon2' name='escon2' size='30'>";
		//realizo un for segun la cantidad de sets
		for($a=1;$a<=$sets;$a++)
		{
			$tabla	.=	"<input type='text' size='1' name='combo2[]'><div id='text2' style='width:200px;z-index:250;position:relative;background:#fff;display:none;border:1px solid #000'></div>";
		}
		
		$tabla	.="</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='submit' value='Guardar' name='guardar'>
					</td>
				</tr>
		</table></form>
					";
		echo $tabla;
	}
	else
	{
		//pinto la primera tablita
		$tabla	=	"<table width='100%'>
							<tr>
								<td colspan='2'><b>EQUIPO 1</b></td>
							</tr>
							<tr>
								<td>
									<b>Jugador 1</b>
								</td>
								<td align='left'>
									<input type='text' id='jugador1' name='jugador1' size='30'  autocomplete='off' onkeyup='listaJugadores(1,this.value)'>
									<div id='text1' style='width:200px;z-index:250;position:absolute;background:#fff;display:none;border:1px solid #000'></div>
									<input type='hidden' id='escon1' name='escon1' size='30'>";
		
		//realizo un for segun la cantidad de sets
		for($a=1;$a<=$sets;$a++)
		{
			$tabla	.=	"<input type='text' size='1' name='combo1[]'>";
		}
		
		$tabla	.=	"</td>
							</tr>
							<tr>
								<td>
									<b>Jugador 2</b>
								</td>
								<td align='left'>
									<input type='text' id='jugador2' name='jugador2' size='30'  autocomplete='off' onkeyup='listaJugadores(2,this.value)'>
									<div id='text2' style='width:200px;z-index:250;position:absolute;background:#fff;display:none;border:1px solid #000'></div>
									<input type='hidden' id='escon2' name='escon2' size='30'>";
		$tabla	.=	"</td>
							</tr>
							<tr>
								<td colspan='2'><b>EQUIPO 2</b></td>
							</tr>
							<tr>
								<td>
									<b>Jugador 1</b>
								</td>
								<td align='left'>
									<input type='text' id='jugador3' name='jugador3' size='30' autocomplete='off' onkeyup='listaJugadores(3,this.value)'>
									<div id='text3' style='width:200px;z-index:250;position:absolute;background:#fff;display:none;border:1px solid #000'></div>
									<input type='hidden' id='escon3' name='escon3' size='30'>";
		//realizo un for segun la cantidad de sets
		for($a=1;$a<=$sets;$a++)
		{
			$tabla	.=	"<input type='text' size='1' name='combo2[]'>";
		}
		
		$tabla	.="</td>
				</tr>
				<tr>
					<td>
						<b>Jugador 2</b>
					</td>
					<td align='left'>
						<input type='text' id='jugador4' name='jugador4' size='30' autocomplete='off' onkeyup='listaJugadores(4,this.value)'>
						<div id='text4' style='width:200px;z-index:250;position:absolute;background:#fff;display:none;border:1px solid #000'></div>
						<input type='hidden' id='escon4' name='escon4' size='30'>";

		$tabla	.="</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='submit' value='Guardar' name='guardar'>
					</td>
				</tr>
		</table></form>
					";
		echo $tabla;
	}
}

//valido si se dio la orden de guardar
if(isset($_POST['guardar']))
{
	//capturo variables
	$tipo_juego	=	$_POST['tipo'];
	$sets		=	$_POST['set'];
	//capturo lo que traiga la caja escondida el cual es el id del jugador.
	$id_jugador1	=	$_POST['escon1'];
	$id_jugador2	=	$_POST['escon2'];
	$id_jugador3	=	$_POST['escon3'];
	$id_jugador4	=	$_POST['escon4'];
	$combo1			=	$_POST['combo1'];
	$combo2			=	$_POST['combo2'];	
	//comienzo el proceso de guardado
	//cuando es tipo 0 juego sencillo
	if($tipo_juego == 0)
	{
		//lo primero que hago es guardar el juego
		$insertar_juego	=	sprintf("INSERT INTO juego (sets,fecha) values('%s','%s')",$sets,date("Y-m-d H:i:s"));
		//ejecuto la consulta
		$result_juego	=	$db->Execute($insertar_juego);
		$juego			=	$db->Insert_ID();
		//ahora debo relacionar el juego con los usuarios que se ingresaron
		$query_relacion_usuario	 	=	sprintf("INSERT INTO jugadorjuego 
												(id,id_juego,combo) 
												values
												('%s','%s','%s'),
												('%s','%s','%s')"
												,$id_jugador1,
												$juego,
												1,
												$id_jugador2,
												$juego,
												2);
		//ejecuto esta consulta
		$result_relacion_usuario	=	$db->Execute($query_relacion_usuario);
		//ahora se debe guardar la relacion del set y los puntajes
		
		for($a=0;$a<=$sets-1;$a++)
		{
			$datos	.=	"(".$juego.",".$_POST['combo1'][$a].",".$_POST['combo2'][$a]."),";
		}
		//elimino la ultima coma
		$datos		=	substr ($datos, 0, strlen($datos) - 1);
		//creo el query
		$query_sets					=	sprintf("INSERT INTO sets (id_juego,puntaje1,puntaje2) VALUES %s",$datos);
		//ejecuto el query
		$result_sets				=	$db->Execute($query_sets);
	}
	else
	{
		//lo primero que hago es guardar el juego
		$insertar_juego	=	sprintf("INSERT INTO juego (sets,fecha) values('%s','%s')",$sets,date("Y-m-d H:i:s"));
		//ejecuto la consulta
		$result_juego	=	$db->Execute($insertar_juego);
		$juego			=	$db->Insert_ID();
		//ahora debo relacionar el juego con los usuarios que se ingresaron
		$query_relacion_usuario	 	=	sprintf("INSERT INTO jugadorjuego 
												(id,id_juego,combo) 
												values
												('%s','%s','%s'),
												('%s','%s','%s'),
												('%s','%s','%s'),
												('%s','%s','%s')"
												,$id_jugador1,
												$juego,
												1,
												$id_jugador2,
												$juego,
												1,
												$id_jugador3,
												$juego,
												2,
												$id_jugador4,
												$juego,
												2);
		//ejecuto esta consulta
		$result_relacion_usuario	=	$db->Execute($query_relacion_usuario);
		//ahora se debe guardar la relacion del set y los puntajes
		
		for($a=0;$a<=$sets-1;$a++)
		{
			$datos	.=	"(".$juego.",".$_POST['combo1'][$a].",".$_POST['combo2'][$a]."),";
		}
		//elimino la ultima coma
		$datos		=	substr ($datos, 0, strlen($datos) - 1);
		//creo el query
		$query_sets					=	sprintf("INSERT INTO sets (id_juego,puntaje1,puntaje2) VALUES %s",$datos);
		//ejecuto el query
		$result_sets				=	$db->Execute($query_sets);
	}
	
}
?>