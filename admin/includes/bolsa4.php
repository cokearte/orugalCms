<?php
ini_set("display_errors",0);
//session_start();
//require('../../core/phpmailer/class.phpmailer.php');
global $core;
global $id;
global $migas;
global $db;
//traigo la informacion de las vacantes existentes
	$vacantes	=	$funciones->obtenerListado(288,' AND visible=1 AND eliminado=0',5000,'principal');
	//traigo las areas de trabajo
	//traigo las areas de trabajo
	$areas_trabajo	=	$funciones->consultaUniversal('principal','tipo_contenido=35','*');
$errores	=	array();
$llamado	=	$funciones->consultaUniversal('curriculum4','idusuario='.$_GET['user'],'*');
extract($llamado[0]);		

	//valido si se dio la orden de guardar o de continuar
	if(isset($_POST['guardar4_x']))
	{
		extract($_POST);
		if(count($errores) == 0)
		{
			//subo los datos a session para llevarlos hasta el final
			$guarda4	=	$funciones->insertarDatos('curriculum4',2,' idusuario='.$_GET['user'],$_POST);
			echo "<script>alert(".$guarda4.");window.parent.closeShadow()</script>";	
		}
	}
?>
  
            	<form name="solicitar" id="slctud" method="post">
            <div id="acadetalle_inf">
            	<fieldset id="campo_slctud">
                
           		<h3>Expectativas Laborales</h3>
                    <p id="infop_sltd">Los campos <b>Resaltados</b> son obligatorios</p>
                    <!-- <p>
                    	<label id="solctdlab" for="fecha">Fecha</label>
                    	<label id="solctdlab" for="nums_fecha">2009-11-13</label>
                    </p>-->
                    <p>
                    	<label id="solctdlab" for="suc_cer">Sucursal m&aacute;s cercana a su domicilio</label>
                        <select id="sucursal_cercana" name="sucurs">
                          <option value="1">Sucursal 1</option>
                        </select>
                    </p>
                    <p>
                    	<label id="solctdlab" for="area-job">&Aacute;rea de trabajo</label>
                        <select id="area_trabajo" name="job_area">
                          <?
                          echo $area_trabajo;
                        	foreach($areas_trabajo as $trabajos)
							{
								if($trabajos['id'] == $job_area)
								{	
                        			echo '<option value="'.$trabajos['id'].'" selected>'.$trabajos['titulo'].'</option>';
								}
								else
								{
									echo '<option value="'.$trabajos['id'].'">'.$trabajos['titulo'].'</option>';
								}		
                        	}
                        ?>
                        </select>
                    </p>
                    <p>
                    	<label id="solctdlab" for="puesto_asp">Puesto al que aspira</label>
                        <select id="vacante" name="vacante">
                        <?
                        
                        	foreach($vacantes as $datos)
							{
								if($vacante == $datos['id'])
								{
									echo '<option value="'.$datos['id'].'" selected>'.$datos['titulo'].'</option>';
								}
								else
								{
                        			echo '<option value="'.$datos['id'].'">'.$datos['titulo'].'</option>';
								}	
                        	}
                        ?>
                        </select>
                    </p>
                    
                    <div id="t_chkcs">
                        <p id="plab">Disponibilidad de reubicaci&oacute;n</p>
                        <p id="pchcks2">
                       	 	<label id="chck1" for="masc">Si</label>
                        	<input type="radio" name="reubicar" value="si"  <?if($reubicar == 'si'){echo 'checked';}?>/>
                        	
                        	<label id="chck1" for="fem">No</label>
                        	<input type="radio" name="reubicar" value="no"  <?if($reubicar == 'no'){echo 'checked';}?>/>
                    </div>
                    <p>
                    	<label id="solctdlab" for="sldo_wish">Sueldo mensual deseado</label>
                    	<input type="text" id="wish_sal" name="sueldo" size="20" value="<?=$sueldo?>"/>
                    </p>
                    <div id="the_tit"><h3>Informaci&oacute;n Importante</h3></div>
                    
                    
                    
                    <div id="t_chkcs">
                        <p id="plab">&iquest;Ha solicitado trabajo con nosotros?</p>
	                        <p id="pchcks2"><label id="chck1" for="masc">Si</label>
                        	<input type="radio" name="solicitado" value="si"  <?if($solicitado == 'si'){echo 'checked';}?>/>
                        	
                        	<label id="chck1" for="fem">No</label>
                        	<input type="radio" name="solicitado" value="no"  <?if($solicitado == 'no'){echo 'checked';}?>/>
                        </p>
                    </div>
                    <p>
                    	<label id="solctdlab" for="cuando1">&iquest;Cu&aacute;ndo?</label>
                    	<input type="text" id="whn1" name="solicitado_cuando" size="20"  value="<?=$solicitado_cuando?>"/>
                    </p>
                    
                    
                    <div id="t_chkcs">
                        <p id="plab">Problemas de espalda</p>
                        <p id="pchcks2">
                        	<label id="chck1" for="masc">Si</label>
                        	<input type="radio" name="espalda" value="si"  <?if($espalda == 'si'){echo 'checked';}?>/>
                        	
                        	<label id="chck1" for="fem">No</label>
                        	<input type="radio" name="espalda" value="no"  <?if($espalda == 'no'){echo 'checked';}?>/>
                        </p>
                    </div>
                    
                    
                    <div id="t_chkcs">
                        <p id="plab">Tatuajes</p>
                        	<p id="pchcks2">
                        		<label id="chck1" for="masc">Si</label>
                        		<input type="radio" name="tatuajes" value="si"  <?if($tatuajes == 'si'){echo 'checked';}?>/>
                        		
                        		<label id="chck1" for="fem">No</label>
                        		<input type="radio" name="tatuajes" value="no"  <?if($tatuajes == 'no'){echo 'checked';}?>/>
                    </div>
                    
                    
                     <div id="t_chkcs">
                        <p id="plab">&iquest;Ciruj&iacute;as recientes?</p>
                        <p id="pchcks2">
                        	<label id="chck1" for="masc">Si</label>
                        	<input type="radio" name="cirujias" value="si"  <?if($cirujias == 'si'){echo 'checked';}?>/>
                        	
                        	<label id="chck1" for="fem">No</label>
                        	<input type="radio" name="cirujias" value="no"  <?if($cirujias == 'no'){echo 'checked';}?>/>
                        </p>
                    </div>
                    
                    
                    
                    <p>
                    	<label id="solctdlab" for="cuales1">&iquest;Cu&aacute;les?</label>
                    	<input type="text" id="wich1" name="cirujias_cuales" value="<?=$cirujias_cuales?>" size="20" />
                    </p>
                    
                    
                    <div id="t_chkcs">
                        <p id="plab">&iquest;Fracturas recientes?</p>
                        <p id="pchcks2">
	                       	<label id="chck1" for="masc">Si</label>
    	                    <input type="radio" name="facturas" value="si"  <?if($facturas == 'si'){echo 'checked';}?>/>
    	                    
    	                    <label id="chck1" for="fem">No</label>
    	                    <input type="radio" name="facturas" value="no"  <?if($facturas == 'no'){echo 'checked';}?>/>
    	                </p>
                    </div>
                    
                    
                    <p>
                    	<label id="solctdlab" for="cuales2">&iquest;Cu&aacute;les?</label>
                    	<input type="text" id="wich2" name="facturas_cuales" value="<?=$facturas_cuales?>" size="20" />
                    </p>
                    
                    
                    <div id="t_chkcs">
                        <p id="plab">&iquest;Haz trabajado en seguridad?</p>
                        <p id="pchcks2">
                        	<label id="chck1" for="masc">Si</label>
                        	<input type="radio" name="trabajo_seguridad" value="si"  <?if($trabajo_seguridad == 'si'){echo 'checked';}?>/>
                        	
                        	<label id="chck1" for="fem">No</label>
                        	<input type="radio" name="trabajo_seguridad" value="no"  <?if($trabajo_seguridad == 'no'){echo 'checked';}?>/>
                    </div>
                    <p>
                    	<label id="solctdlab" for="qlugar">&iquest;En que lugar?</label>
                    	<input type="text" id="wplc" name="lugar" value="<?=$lugar?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="cm_sbr">&iquest;C&Oacute;mo te enteraste de este empleo?</label>
                    	<input type="text" id="hw_knw" name="entero" value="<?=$entero?>"  size="20" /></p>
                
                
                    
                    <div id="botones_slctd_f">
                        <!--<p id="lipiar"><input type="image" src="images/bolsadetrabajo/limpiar_btn.jpg" width="79" height="25" /></p>
                        <p id="lipiar"><a href="index.php?id=<?=$id?>&acciones=3"><img border="0" src="images/bolsadetrabajo/anterior_btn.jpg" width="79" height="25" /></a></p>-->
                      <p id="lipiar"><input type="image" src="../../images/bolsadetrabajo/guardar_btn.jpg" name="guardar4" width="79" height="25" /></p>
                    </div>
                
                </fieldset>
             </div>
            </form>
           