<?php
ini_set("display_errors",0);
//session_start();
//require('../../core/phpmailer/class.phpmailer.php');
global $core;
global $id;
global $migas;
global $db;
global $funciones;
$errores	=	array();
$llamado	=	$funciones->consultaUniversal('curriculum3','idusuario='.$_GET['user'],'*');
extract($llamado[0]);		

	//valido si se dio la orden de guardar o de continuar
	if(isset($_POST['guardar3_x']))
	{
		extract($_POST);
		//comienzo con la validacion de los campos
		if(empty($empresa_1))
		{
			array_push($errores,"Por favor escriba el nombre de la Actual o &Uacute;ltima Empresa");
		}
		if($fecha_1_ano == 0 or $fecha_1_mes == 0 or $fecha_1_dia==0)
		{
			array_push($errores,"Por favor seleccione la fecha de inicio, A&ntilde;o, Mes y Dia");
		}
		if($fecha_fin1_ano == 0 or $fecha_fin1_mes == 0 or $fecha_fin1_dia==0)
		{
			array_push($errores,"Por favor seleccione la fecha de finalizacion, A&ntilde;o, Mes y Dia");
		}
		if(empty($puesto_1))
		{
			array_push($errores,"Por favor escriba el cargo que tenia en esta empresa");
		}
		if(empty($sueldo_1))
		{
			array_push($errores,"Por favor escriba el sueldo que recibia en esta empresa");
		}
		if(empty($jefe_1))
		{
			array_push($errores,"Por favor escriba el nombre de su jefe inmediato");
		}
		if(empty($logros_1))
		{
			array_push($errores,"Por favor escriba los logros obtenidos en esta empresa");
		}
		if(empty($razon_1))
		{
			array_push($errores,"Por favor escriba la razon de separacion de esta empresa");
		}
		if(count($errores) == 0)
		{
			//procedo a guardar la informacion
			$guarda3	=	$funciones->insertarDatos('curriculum3',2,' idusuario='.$_GET['user'],$_POST);
			echo "<script>alert(".$guarda3.");window.parent.closeShadow()</script>";	
		}
	}
?>
    <form name="solicitar" id="slctud" method="post">
     <div id="acadetalle_inf">
            <h3>Experiencia Laboral</h3>
                    <p>
	                    <ul style="margin:10px 0 0 0;text-align:left">
	                    	<li>Los campos <b>Resaltados son obligatorios</b></li> 
	                    </ul>
                    </p>
                    <br>
                    <?if(count($errores)>0){?>
                    	<div style="text-align:left;border:1px solid #6C7C8B;color:red;font-weight:bold;background:#D6D7D9">
                    	<ul>
                    	<?
                    		foreach($errores as $error)
                    		{
                    			echo "<li>".$error."</li>";
                    		}
						?>
						</ul>
                    	</div>
                    	<?}?>
            	<fieldset id="campo_slctud">
                    <p>
                    	<label id="solctdlab" for="act_emp"><b>Empresa Actual o &Uacute;ltima</b></label>
                    	<input type="text" id="empl_now" name="empresa_1" size="20" value="<?=$empresa_1?>"/>
                    </p>
                    <p>
                    	<label id="born_data" for="data_inicio"><b>Fecha inicio trabajo</b></label>
                  		<select id="anio" name="fecha_1_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $fecha_1_ano)
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
                        <select id="mes" name="fecha_1_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $fecha_1_mes)
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
                        <select id="dia" name="fecha_1_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $fecha_1_dia)
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
                    	<label id="born_data" for="data_inicio"><b>Fecha fin trabajo</b></label>
                        
                  		<select id="anio" name="fecha_fin1_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $fecha_fin1_ano)
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
                        <select id="mes" name="fecha_fin1_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $fecha_fin1_mes)
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
                        <select id="dia" name="fecha_fin1_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $fecha_fin1_dia)
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
                    	<label id="solctdlab" for="puesto"><b>Puesto</b></label>
                    	<input type="text" id="psto" name="puesto_1" size="20"  value="<?=$puesto_1?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="sueldo"><b>Sueldo</b></label>
                    	<input type="text" id="salary" name="sueldo_1" size="20"  value="<?=$sueldo_1?>"/>
                    </p>                
                    <p>
                    	<label id="solctdlab" for="jefe"><b>Jefe y Contacto</b></label>
                    	<input type="text" id="boss" name="jefe_1" size="20"  value="<?=$jefe_1?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="resp"><b>Responsabilidades y logros</b></label>
                    	<textarea id="resps" name="logros_1" rows="5" cols="30"><?=$logros_1?></textarea>
                    </p>
                    <p>
                    	<label id="solctdlab" for="razon"><b>Raz&oacute;n de separaci&oacute;n</b></label>
                    	<input type="text" id="reason" name="razon_1" size="20"  value="<?=$razon_1?>"/>
                    </p>
                    
                    
                    
                    <br><br>
                    <!-- SEGUNDA EXPERIENCIA LABORAL -->
                    <p>
                    	&nbsp;
                    </p>
                    <p>
                    
                    	<label id="solctdlab" for="act_emp">Empresa Anterior o Pen&uacute;ltima</label>
                    	<input type="text" id="empl_now" name="empresa_2" size="20" value="<?=$empresa_2?>"/>
                    </p>
                    <p>
                    	<label id="born_data" for="data_inicio">Fecha inicio trabajo</label>
                  		<select id="anio" name="fecha_2_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $fecha_2_ano)
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
                        <select id="mes" name="fecha_2_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $fecha_2_mes)
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
                        <select id="dia" name="fecha_2_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $fecha_2_dia)
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
                    	<label id="born_data" for="data_inicio">Fecha fin trabajo</label>
                        
                  		<select id="anio" name="fecha_fin2_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $fecha_fin2_ano)
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
                        <select id="mes" name="fecha_fin2_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $fecha_fin2_mes)
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
                        <select id="dia" name="fecha_fin2_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $fecha_fin2_dia)
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
                    	<label id="solctdlab" for="puesto">Puesto</label>
                    	<input type="text" id="psto" name="puesto_2" size="20"  value="<?=$puesto_2?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="sueldo">Sueldo</label>
                    	<input type="text" id="salary" name="sueldo_2" size="20"  value="<?=$sueldo_2?>"/>
                    </p>                
                    <p>
                    	<label id="solctdlab" for="jefe">Jefe y Contacto</label>
                    	<input type="text" id="boss" name="jefe_2" size="20"  value="<?=$jefe_2?>"/>
                    </p>
                    <p>
                    	<label id="solctdlab" for="resp">Responsabilidades y logros</label>
                    	<textarea id="resps" name="logros_2" rows="5" cols="30"><?=$logros_2?></textarea>
                    </p>
                    <p>
                    	<label id="solctdlab" for="razon">Raz&oacute;n de separaci&oacute;n</label>
                    	<input type="text" id="reason" name="razon_2" size="20"  value="<?=$razon_2?>"/>
                    </p>
                
                    
                    <div id="botones_slctd_f">
                       <!--  <p id="lipiar"><input type="image" src="../images/bolsadetrabajo/limpiar_btn.jpg" width="79" height="25" /></p>
                        <p id="lipiar"><a href="index.php?id=<?=$id?>&acciones=2"><img border="0" src="images/bolsadetrabajo/anterior_btn.jpg" width="79" height="25" /></a></p>-->
                       <p id="lipiar"><input type="image" src="../../images/bolsadetrabajo/guardar_btn.jpg" name="guardar3" width="79" height="25"></p>
                    </div>
                
                </fieldset>
            </div>
            </form>