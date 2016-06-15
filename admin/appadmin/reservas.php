<?php
ini_set("display_errors",0);
/*
 * Apicativo que controla el funcionamiento de los usuarios de Veerkamp
 */
global $db;
require("../core/phpmailer/class.phpmailer.php");
global $funciones;
$queryReserva	=	 sprintf("SELECT * FROM reservas ORDER BY idReserva DESC");
$listaReservas = $db->GetAll($queryReserva);
?>
<?php if(count($listaReservas) > 0){ ?>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th class="text-center">NOMBRE</th>
				<th class="text-center">FECHA</th>
				<th class="text-center">HORA</th>
				<th class="text-center">TEL&Eacute;FONO</th>
				<th class="text-center">EMAIL</th>
				<th class="text-center">COMENTARIOS</th>
				<th class="text-center">RESERVA</th>
			</tr>
			<?php foreach($listaReservas as $res){ ?>
				<tr>
					<td><?php echo $res['nombre'] ?></td>
					<td><?php echo date("Y-m-d",strtotime($res['fecha']))?></td>
					<td><?php echo date("H:s",strtotime($res['hora']))?></td>
					<td><?php echo $res['telefono'] ?></td>
					<td><?php echo $res['email'] ?></td>
					<td><?php echo $res['comentarios'] ?></td>
					<td><strong><?php echo strtoupper($res['reservaCodigo'])?></strong></td>
				</tr>
			<?php } ?>
		</table>
	</div>
<?php }else{ ?>
	<div class="alert alert-warning alert-dismissable">
  		<!--<button type="button" class="close">&times;</button>-->
  		No hay reservaciones registradas.
	</div>
<?php } ?>
