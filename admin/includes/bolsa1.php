<?php
//ini_set("display_errors",1);
//session_start();
require('../../core/phpmailer/class.phpmailer.php');
require('../includes/application.php');
require('../../config/configuracion.php');
require('../../config/conexion_3.php');
require('../../core/funciones.class.php');
$funciones	=	new Funciones();
global $core;
global $id;
global $migas;
global $db;
$contador_anos	=	date("Y");
//listado de años
$anos			=	array();
for($a=1;$a<=60;$a++)
{
	//$anos['ano']	=	$contador_anos;
	array_push($anos,$contador_anos);
	$contador_anos--;
}
//listado de meses
$meses			=	array();
$contador_meses	=	1;
for($i=1;$i<=12;$i++)
{
	array_push($meses,$contador_meses);
	$contador_meses++;
}
//listado de dias
$dias			=	array();
$contador_dias	=	1;
for($d=1;$d<=31;$d++)
{
	array_push($dias,$contador_dias);
	$contador_dias++;
}
$errores	=	array();
function generaSelect($nombre)
{
	$link	=	mysql_connect('localhost','root','0000');
	$db		=	mysql_select_db('base',$link);
	
	$consulta	=	mysql_query("SELECT id,opcion FROM paises2");
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='".$nombre."' id='paises2' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}

	$llamado	=	$funciones->consultaUniversal('curriculum1','idusuario='.$_GET['user'],'*');
	//var_dump($llamado);
	//$_SESSION['form_1']	=	$llamado[0];
	//extraigo el porst
	extract($llamado[0]);	
	
	//var_dump($_SESSION['form_1']);
	//valido si se dio la orden de guardar o de continuar
	if(isset($_POST['guardar1_x']))
	{
		
		extract($_POST);
		//comienzo con la validacion de los campos
		if(empty($nombres))
		{
			array_push($errores,"Debe escribir su nombre");
		}
		if(empty($primer_apellido))
		{
			array_push($errores,"Debe escribir su primer apellido");
		}
		if($nac_ano == 0 or $nac_mes == 0 or $nac_dia==0)
		{
			array_push($errores,"Recuerde seleccionar la fecha de nacimiento A&ntilde;o - Mes - Dia");
		}
		if(empty($mail))
		{
			array_push($errores,"Debe escribir su Correo El&eacute;ctronico, este sera su nombre de usuario");
		}
		if(!empty($mail) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$mail))
		{
			array_push($errores,"La sintaxis del correo es erronea, recuerde que debe ser correo@dominio.com &oacute; .com.xx");
		}
		if(empty($clave1))
		{
			array_push($errores,"Debe escribir una Contrase&ntilde;a");
		}
		if(!empty($clave1) and empty($clave2))
		{
			array_push($errores,"Debe repetir su Contrase&ntilde;a");
		}
		if(!empty($clave1) and !empty($clave2) and $clave1 != $clave2)
		{
			array_push($errores,"Las contrase&ntilde;a no coinciden, por favor verifique");
		}
		if(count($errores) == 0)//procedo a guardar el formulario 1
		{
			
			//procedo a guardar los datos por medio de la funcion de guardado automatico.
			$final = $funciones->insertarDatos("curriculum1",'2',' idusuario='.$_GET['user']);
			echo "<script>alert(".$final.");window.parent.closeShadow()</script>";	
			array_push($errores,$final);
			//subo todo a session, seran sessiones diferentes por formulario para que se pueda hacer persistencia
			//$_SESSION['form_1']		=	$_POST;
			//echo "<script>document.location='index.php?id=".$id."&acciones=2'</script>";
			//ahora envio al usuario al fomulario 2
		}
		
	}
	//include('../html/bolsa1.html');
?>
 <script src="../../js/select_dependientes_3_niveles.js"></script> 
        <div id="acadetalle_inf">
            <fieldset id="campo_slctud">
            <form name="archivo" id="slctud2"  action="../includes/carga.php" target="miIFrame" method="post" enctype="multipart/form-data">

               		<h3>Datos Generales</h3>
               		<p>
	                    <ul style="margin:10px 0 0 0;text-align:left">
	                    	<li>Si desea subir su curriculum adem&aacute;s de llenar la forma favor de agregarlo aqu&iacute;. 1Mb espacio permitido y en formato PDF</li>
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
                    <br>
                    <!-- 
                    <p>
                    	<label id="solctdlab" for="fst_apll">Escoja su curriculum</label>
                    	<input type="file" name="archivo" id="el_cv" onChange="document.archivo.submit()"/>
                   	</p>
                   	<p>
                   		<iframe name="miIFrame" id="miIFrame" border="0" style="width:400px;height:50px;border:0">asdasdasd</iframe>
                   	</p> -->
            </form>
            <script>
            	function recibir(archivo)
            	{
            		//document.getElementById('texto_cargado').innerHTML=archivo+" Borrar";
            		document.getElementById('adjunto').value=archivo;
            	}
            </script>
            <form method="post" name="datos">       		
                   	<p>
                    	<label id="solctdlab" for="nom">Curriculum Cargado</label>
                    	<input type="text" id="adjunto" name="adjunto" value="<?=$adjunto?>"  style="width:200px;border:0" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="nom"><b>Nombres</b></label>
                    	<input type="text" id="nam" name="nombres" value="<?=$nombres?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="fst_apll"><b>Primer apellido</b></label>
                    	<input type="text" id="fstapd" name="primer_apellido"  value="<?=$primer_apellido?>" size="20" />
                    </p>
                	<p>
                		<label id="solctdlab" for="scnd_apll">Segundo Apellido</label>
                		<input type="text" id="sdo_apd" name="segundo_apellido"  value="<?=$segundo_apellido?>" size="20" />
                	</p>
                    <p id="plab">Sexo</p>
                	<p id="pchcks">
                		<label id="chck1" for="masc">Masculino</label>
                		<input type="radio" name="sexo" value="masculino"  <?if($sexo == 'masculino'){echo 'checked';}?>/>
                		<label id="chck1" for="fem">Femenino</label>
                		<input type="radio" name="sexo" value="femenino" <?if($sexo == 'femenino'){echo 'checked';}?>/>
                	</p>                    
                    <p>
                    	<label id="born_data" for="data_brn"><b>Fecha de nacimiento</b></label>
                  		<select id="anio" name="nac_ano">
                  				<option value="0">A&ntilde;o</option>
                        	<?
                        		foreach($anos as $info_ano)
                        		{
									if($info_ano == $nac_ano)
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
                        <select id="mes" name="nac_mes">
                        	<option value="0">Mes</option>
                        	<?
                        		foreach($meses as $info_mes)
                        		{
									if($info_mes == $nac_mes)
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
                        <select id="dia" name="nac_dia">
                        	<option value="0">Dia</option>
                        	<?
                        		foreach($dias as $info_dia)
                        		{
									if($info_dia == $nac_dia)
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
                    
                    
                    <p id="plab">Lugar de nacimiento</p>
                    
                    <div id="selcs">
                    	<div id="demoIzq"><?php generaSelect('l_pais'); ?></div>
                    	<div id="demoMed">
							<select disabled="disabled" name="l_estado" id="estados2">
								<option value="0">Selecciona opci&oacute;n...</option>
							</select>
						</div>
		                <div id="demoDer">
							<select disabled="disabled" name="l_delega" id="delegaciones2">
								<option value="0">Selecciona opci&oacute;n...</option>
							</select>
						</div>
                	</div>
                    <p>
                    	<label id="solctdlab" for="est_cvl">Estado civil</label>
                        <select id="selcvl" name="estado_civil">
                          <option value="Soltero">Soltero</option>
                          <option value="Casado">Casado</option>
                          <option value="Union Libre">Union Libre</option>
                          <option value="Sometido">Sometido</option>
                        </select>
                    </p>
                    <p>	
                    	<label id="solctdlab" for="calle">Calle</label>
                    	<input type="text" id="street" name="calle" value="<?=$calle?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="numero_call">N&uacute;mero</label>
                    	<input type="text" id="num_street" name="numero" value="<?=$numero?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="piso">Piso</label>
                    	<input type="text" id="floor" name="piso" value="<?=$piso?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="piso">Departamento</label>
                    	<input type="text" id="floor" name="departamento" value="<?=$departamento?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="piso">C&oacute;digo Postal</label>
                    	<input type="text" id="floor" name="codigo" value="<?=$codigo?>" size="20" />
                    </p>

                    <p>
                    	<label id="solctdlab" for="pais2">Pa&iacute;s</label>
                        <select id="pais" name="cnt2">
                          	<option value="1">Mexico</option>
                            <option value="1">Colombia</option>
                            <option value="1">Hungria</option>
                            <option value="1">Suecia</option>
                        </select>
                    </p>
                    <p>
                    	<label id="solctdlab" for="estado2">Estado</label>
                        <select id="estado" name="stt2">
                          	<option value="1">Mexico</option>
                            <option value="1">Colombia</option>
                            <option value="1">Hungria</option>
                            <option value="1">Suecia</option>
                        </select>
                    </p>
                    <p>
                    	<label id="solctdlab" for="ciudad2">Ciudad</label>
                        <select id="ciudad" name="cty2">
                          	<option value="1">Mexico</option>
                            <option value="1">Colombia</option>
                            <option value="1">Hungria</option>
                            <option value="1">Suecia</option>
                        </select>
                    </p>
                    <p>
                    	<label id="solctdlab" for="tele">Tel&eacute;fono</label>
                    	<input type="text" id="phn" name="telefono" value="<?=$telefono?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="correo"><b>E-mail</b></label>
                    	<input type="text" id="mail" name="mail" value="<?=$mail?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="nom"><b>Contrase&ntilde;a</b></label>
                    	<input type="password" id="nam" name="clave1" value="<?=$clave1?>" size="20" />
                    </p>
                    <p>
                    	<label id="solctdlab" for="nom"><b>Repita la Contrase&ntilde;a</b></label>
                    	<input type="password" id="nam" name="clave2" value="<?=$clave2?>" size="20" />
                    </p>
                    <div id="botones_slctd_f">
                        <!-- <p id="lipiar">
                        	<input type="image" src="../../images/bolsadetrabajo/limpiar_btn.jpg" width="79" height="25" />
                        </p>-->
                        <p id="lipiar">
                        	<input type="image" src="../../images/bolsadetrabajo/guardar_btn.jpg" width="79" height="25" name="guardar1">
                        </p>
                    </div>
                </fieldset>
            </form>
        </div>