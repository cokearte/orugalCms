<?php
ini_set("display_errors",0);
//session_start();
//require('../../core/phpmailer/class.phpmailer.php');
global $core;
global $id;
global $migas;
global $db;
$errores	=	array();
$llamado	=	$funciones->consultaUniversal('curriculum2','idusuario='.$_GET['user'],'*');
extract($llamado[0]);		

	//valido si se dio la orden de guardar o de continuar
	if(isset($_POST['guardar2_x']))
	{
		extract($_POST);
		if(count($errores) == 0)
		{
			//subo los datos a session para llevarlos hasta el final
			$guarda2	=	$funciones->insertarDatos('curriculum2',2,' idusuario='.$_GET['user'],$_POST);
			echo "<script>alert(".$guarda2.");window.parent.closeShadow()</script>";	
		}
	}
?>
 <form action="" name="solicitar" id="slctud" method="post">
  <div id="acadetalle_inf">
            	<fieldset id="campo_slctud">
                
               		<h3>Estudios</h3>
                    <p id="infop_sltd">Los campos <b>Resaltados </b>son obligatorios</p>
                    <p>
                    	<label id="solctdlab" for="pstudy">Pa&iacute;s de estudio</label>
                    	<input type="text" id="cstudy" name="pais_estudio" size="20" value="<?=$pais_estudio?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="ult_grd">&Uacute;ltimo grado de estudios</label>
                    	<input type="text" id="lst_grd" name="ultimo_grado" size="20" value="<?=$ultimo_grado?>" />
                    </p>
                	<p>
                		<label id="solctdlab" for="instituto">Instituci&oacute;n</label>
                		<input type="text" id="instte" name="institucion" size="20"  value="<?=$institucion?>"/>
                	</p>
                    <p>
                    	<label id="solctdlab" for="instituto">Instituci&oacute;n t&iacute;tulo</label>
                    	<input type="text" id="instte" name="titulo_inst" size="20"  value="<?=$titulo_inst?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="instituto">&Aacute;rea de estudio</label>
                    	<input type="text" id="instte" name="area_estudio" size="20"  value="<?=$area_estudio?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="instituto">T&iacute;tulo obtenido</label>
                    	<input type="text" id="instte" name="titulo_obtenido" size="20"  value="<?=$titulo_obtenido?>"/>
                    </p>
                                       
                    <p>
                    	<label id="born_data" for="data_inicio">Fecha de inicio</label>
                  			<select id="anio" name="f_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $f_ano)
									{
										echo	'<option value="'.$info_ano.'" selected>'.$info_ano.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_ano.'">'.$info_ano.'</option>';
									}
								}
                        	?>
                        </select>
                        <select id="mes" name="f_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $f_mes)
									{
										echo	'<option value="'.$info_mes.'" selected>'.$info_mes.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_mes.'">'.$info_mes.'</option>';
									}
								}
                        	?>
                        </select>
                        <select id="dia" name="f_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $f_dia)
									{
										echo	'<option value="'.$info_dia.'" selected>'.$info_dia.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_dia.'">'.$info_dia.'</option>';
									}
								}
                        	?>
                        </select>                        
                </p>                
                </p>
                
                	
                    
                    <div id="t_chkcs">
                        <p id="plab">Estudia Actualmente</p>
                        <p id="pchcks2">
                        	<label id="chck1" for="masc">Si</label>
                        		<input type="radio" name="estudia_actual" value="si"  <?if($estudia_actual == 'si'){echo 'checked';}?>/>
                        	<label id="chck1" for="fem">No</label>
                        		<input type="radio" name="estudia_actual" value="no"  <?if($estudia_actual == 'no'){echo 'checked';}?>/>
                        </p>
                    </div>
                    <p>
                    	<label id="solctdlab" for="hora_est">Horario de estudios actuales</label>
                    	<input type="text" id="std_hr" name="horario" size="20" value="<?=$horario?>"/>
                    </p>
                    <p>
                    	<label id="born_data" for="data_fin">Fecha fin</label>
                  		<select id="anio" name="ff_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $ff_ano)
									{
										echo	'<option value="'.$info_ano.'" selected>'.$info_ano.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_ano.'">'.$info_ano.'</option>';
									}
								}
                        	?>
                        </select>
                        <select id="mes" name="ff_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $ff_mes)
									{
										echo	'<option value="'.$info_mes.'" selected>'.$info_mes.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_mes.'">'.$info_mes.'</option>';
									}
								}
                        	?>
                        </select>
                        <select id="dia" name="ff_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $ff_dia)
									{
										echo	'<option value="'.$info_dia.'" selected>'.$info_dia.'</option>';
									}
									else
									{
										echo	'<option value="'.$info_dia.'">'.$info_dia.'</option>';
									}
								}
                        	?>
                        </select>                  
                </p>
                    <p>
                    	<label id="solctdlab" for="promedio">Promedio</label>
                    	<input type="text" id="prom" name="promedio" size="20" value="<?=$promedio?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="ot_est">Otros estudios</label>
                    	<input type="text" id="oth_st" name="otros_estudios" size="20" value="<?=$otros_estudios?>"/>
                    </p>
                    <div id="t_chkcs">
                        <p id="plab">Manejas PC</p>
                        <p id="pchcks2">
                        	<label id="chck1" for="masc">Si</label>
                        		<input type="radio" name="maneja_pc" value="si"  <?if($maneja_pc == 'si'){echo 'checked';}?>/>
                        	<label id="chck1" for="fem">No</label>
                        		<input type="radio" name="maneja_pc" value="no"  <?if($maneja_pc == 'no'){echo 'checked';}?>/>
                        </p>
                    </div>
                    <p>
                    	<label id="solctdlab" for="paq">Paqueter&iacute;a</label>
                    	<input type="text" id="pack" name="paqueteria" size="20" value="<?=$paqueteria?>"/>
                    </p>
                
                
                    
                    <div id="botones_slctd_f">
                        <!-- <p id="lipiar"><input type="image" src="images/bolsadetrabajo/limpiar_btn.jpg" width="79" height="25" /></p>
                        <p id="lipiar"><a href="index.php?id=<?=$id?>&acciones=1"><img border="0" src="images/bolsadetrabajo/anterior_btn.jpg" width="79" height="25" /></a></p>-->
                         <p id="lipiar"><input type="image" src="../../images/bolsadetrabajo/guardar_btn.jpg" name="guardar2" width="79" height="25"></p>
                    </div>
                
                </fieldset>
            </div>
            </form>