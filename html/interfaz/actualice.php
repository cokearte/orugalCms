<?php
require("admin/includes/application.php");
require(_CONEX);
require("admin/includes/class_mail.php");
require(_FUNCCI);
require("admin/includes/class.phpmailer.php");

if(isset($_POST['enviar']))
{
		extract($_POST);
		//validacion de campos
		if(empty($nombres))
		{
			echo "<script>alert('Debe escribir su nombre')</script>";
		}
		elseif(empty($apellidos))
		{
			echo "<script>alert('Debe escribir sus apellidos')</script>";
		}
		elseif(empty($identidad))
		{
			echo "<script>alert('Debe escribir su documento de identidad')</script>";
		}
		elseif(!empty($identidad) and !is_numeric($identidad))
		{
			echo "<script>alert('Su documento de identidad solo debe llevar numeros')</script>";
		}
		elseif(empty($ano_nac) or empty($dia_nac) or empty($mes_nac))
		{
			echo "<script>alert('Seleccione la Fecha de nacimiento')</script>";
		}
		elseif(empty($direccion))
		{
			echo "<script>alert('Debe escribir su direccion')</script>";
		}
		elseif(empty($direccion_of))
		{
			echo "<script>alert('Debe escribir la direccion de su oficina')</script>";
		}
		elseif(empty($ciudad))
		{
			echo "<script>alert('Debe escribir la ciudad')</script>";
		}
		elseif(empty($barrio))
		{
			echo "<script>alert('Debe escribir el Barrio')</script>";
		}
		elseif(empty($depto))
		{
			echo "<script>alert('Debe escribir el departamento')</script>";
		}
		elseif(empty($telefono))
		{
			echo "<script>alert('Debe escribir su telefono')</script>";
		}
		elseif(!empty($telefono) and !is_numeric($telefono))
		{
			echo "<script>alert('Su numero de telefono solo debe contener numeros')</script>";
		}
		elseif(empty($mail))
		{
			echo "<script>alert('Debe escribir su mail')</script>";
		}
		elseif(!empty($mail) and !ereg('([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+',$mail))
		{
			echo "<script>alert('La sintaxis de su mail es erronea')</script>";
		}
		else
		{
			$asunto="ACTUALIZACIÓN DE  DATOS";
			$to1="amigo.sos@aldeasinfantiles.org.co,luis.garzon@aldeasinfantiles.org.co";
			//$to1="farez@paxzu.com";
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$mensaje="
				<ul>
				<li>$ayud </br></br></li>
				<li>Nombre: $nombres </li>
				<li>Apellidos: $apellidos </li>
				<li>C&eacute;dula de ciudadan&iacute;a: $identificacion </li>
				<li>Ciudad: $ciudad </li>
				<li>Tel&eacute;fono: $telefono </li>
				<li>Celular: $celular </li>
				<li>Direcci&oacute;n de correspondencia: $direccion </li>
				<li>Correo electr&oacute;nico: $mail </li>";
				if($tipo == 'credito')
				{
					$mensaje .="<li>Autorizo debitar de mi tarjeta de cr&eacute;dito: </li>
					<li>No. $numero </li>
					<li>Vence Mes: $mes </li>
					<li>A&ntilde;o: $ano</li>
					<li>Tarjeta: $tarjeta </li>
					<li>Banco: $banco </li>";
				}
				else
				{
					$mensaje .="<li>Autorizo debitar de mi Cuenta Bancaria</li>";
					$mensaje .="<li>No".$numero_otro."</li>
					<li>Tipo de Cuenta:". $tipo_cuenta ."</li>
					<li>Banco: ".$banco_2."</li>";	
				}
				echo "</ul>";
				$campos	=	'';
				$datos	=	'';
				foreach($_POST as $key=>$data)
				{
					//echo $data."<br>";
					if($key!='enviar')
					{
						$campos		.=	$key.",";
						$datos		.=	"'".$data."',";
					}
				}
				//elimino el ultimo caracter de cada variable
				$campos			=	substr($campos,0,strlen($campos)-1);
				$datos			=	substr($datos,0,strlen($datos)-1);
				//ejecuto la consulta
				$query_insert	=	sprintf("INSERT into actualice (id,%s,fecha) VALUES ('%s',%s,'%s')",$campos,$id_cliente,$datos,date("Y-m-d H:i:s"));
				
				if(mail($to1,$asunto,$mensaje,$headers))
				{	
					//$link=conexiondb();
				   	if(conexiondb())
				   	{
				   		$env = mysql_query($query_insert);
					}
					echo "<script>alert('Sus datos han sido actualizados exitosamente. A trav\xe9s de correo electr\xf3nico le estaremos notificando el número con el cuál usted participar\xe1 en la rifa de la grabadora mp3.  Aplican condiciones y restricciones. Mayores informes www.aldeasinfantiles.org.co');</script>";
				}
				else
				{
					echo "<script>alert('Su informacion no fue');document.location='index.php';</script>";
				}
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<link type="text/css" rel="stylesheet" href="estilosf3.css" />
<title>ALDEAS INFANTILES - AMIGO SOS </title>
<meta name="Description" lang="es" content=""/>
<meta name="robots" content="All"/>
<meta name="Keywords" lang="es" content=""/>
<meta name="author" content=""/>
<meta http-equiv="content-language" content="es"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="pragma" content="No-Cache"/>
<script src="https://www.aldeasinfantiles.org.co/unitpngfix.js" type="text/javascript"></script>
<script src="https://www.aldeasinfantiles.org.co/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<style type="text/css">
.button
{
  position:relative;
  top:-50px;
  left:100px;
}
</style>
<script type="text/javascript">
function cambiavalor(form)
{
      form.otra_cant.value="";
}

function cambiavalor1(form)
{
      form.otra_cant2.value="";
}
function cambiavalor3(form)
{
	  form.otra_cant2.value="";
}
</script>
<!--Codigo Para Google Analithics 2010-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17322502-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--Fin del Codigo de Google Analitics-->
</head>
<body>
       <div id="todo">
			<div id="contenido">
			<!-- 
                <div id="logo">
					<a href="https://www.aldeasinfantiles.org.co/"><img src="https://www.aldeasinfantiles.org.co/images/LOGO.jpg"  border="0" /></a>
				</div> -->
                  <div id="cabezote">
			<script type="text/javascript">
AC_FL_RunContent( 'codebase','https://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','900','height','160','id','banner','align','middle','src','https://www.aldeasinfantiles.org.co/aleatorio','quality','high','wmode','transparent','name','banner','allowscriptaccess','sameDomain','pluginspage','https://www.macromedia.com/go/getflashplayer','movie','https://www.aldeasinfantiles.org.co/aleatorio' ); //end AC code
</script><noscript><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="900" height="160" id="banner" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="movie" value="https://www.aldeasinfantiles.org.co/aleatorio.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><embed src="https://www.aldeasinfantiles.org.co/aleatorio.swf" quality="high" width="900" wmode="transparent" height="160" name="banner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" />
			</object></noscript>
		</div>
          <ul id="menu">
  					<li class="enlinea menu"><a href="index.php"><img img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu1.jpg" border="0" /></a></li>
					<li class="enlinea menu"><a href="https://www.aldeasinfantiles.org.co/historia/"><img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu2.jpg"  border="0" /></a></li>
					<li class="enlinea menu"><a href="https://www.aldeasinfantiles.org.co/organizacion/"><img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu3.jpg"  border="0" /></a>																																									</li>

					<li class="enlinea menu"><a href="https://www.aldeasinfantiles.org.co/programas/"><img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu4.jpg" border="0" /></a></li>
					<li class="enlinea menu"><a href="https://www.aldeasinfantiles.org.co/noticias/"><img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu5.jpg"  border="0" /></a></li>
					<li class="enlinea menu"><a href="https://www.aldeasinfantiles.org.co/contactenos/"><img src="https://www.aldeasinfantiles.org.co/images/botones/btn_menu6.jpg"  border="0" /></a></li>															                </ul>
                 <?require(_IZQ2);?>
         <?php
$link=conexiondb();
if($link)
{
	$sqli=mysql_query("select * from info_form");
	$rowi=mysql_fetch_array($sqli);
}
?>
			<div id="info_int">
				 <div>

                    <form name="amigosos" method="post" style="margin:0; padding:0">
                <div id="form">
			   <input type="hidden" name="valor2" value="<?php echo $valor; ?>"/> 



             </div>  
                <div id="form">
                <style>
                	.titulos{text-align:center; color:#FFFFFF; font-weight:bold;background:#00ADEE}
                	td{padding:3px 0 3px 0}
                </style>
				<table width="660px" style="font-size:0.8em;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" class="titulos">
						ACTUALICE SUS DATOS AQU&Iacute;
					</td>
				</tr>
					<tr>
						<td>
							<label>Nombres</label>
							<input type="text" name="nombres" size="35" value="<?=$_POST['nombres']?>"/>
						</td>
						<td>
							<label>Apellidos</label>	
							<input type="text" name="apellidos" size="30"  value="<?=$_POST['apellidos']?>"/>
						</td>
					</tr>	
					<tr>
						<td>
							<div style="width:80px;float:left">Doc Identidad</div>
							<div style="float:right;color:#00ADEE;font-size:0.8em;margin:0 50px 0 0;//margin:0 25px 0 0">
								<input type="text" name="identidad" size="25" value="<?=$_POST['identidad']?>"/>
								<div>S&oacute;lo N&uacute;mero, sin (.) (-) ( )</div>	
							</div>
						</td>
						<td>
							<div style="width:80px;float:left">Fecha Nacimiento</div>
							<div style="float:right;width:180px;margin:0 20px 0 0">
								<div style="width:50px;float:right">
								<select class="text_f" name="ano_nac">
		                                    <option value="">A&Ntilde;O</option>
											<?php
													$ano_n=2010;
													for($a=0;$a<=30;$a++)
													{
											?>
														<option value="<?=$ano_n?>" <? if($_POST["ano_nac"]==$ano_n):?> selected="selected"<? endif;?>><?=$ano_n?></option>
											<?php
														$ano_n--;
													}
											?>
											</select>
									A&ntilde;o
								</div>
								<div style="width:73px;float:right">
									<select class="text_f2" name="mes_nac">
                                        <option value="ENERO" <? if($_POST["mes_nac"]=="ENERO"):?> selected="selected"<? endif;?>>ENERO</option>
                                        <option value="FEBRERO" <? if($_POST["mes_nac"]=="FEBRERO"):?> selected="selected"<? endif;?>>FEBRERO</option>
									    <option value="MARZO" <? if($_POST["mes_nac"]=="MARZO"):?> selected="selected"<? endif;?>>MARZO</option>
                                        <option value="ABRIL" <? if($_POST["mes_nac"]=="ABRIL"):?> selected="selected"<? endif;?>>ABRIL</option>
                                        <option value="MAYO" <? if($_POST["mes_nac"]=="MAYO"):?> selected="selected"<? endif;?>>MAYO</option>
                                        <option value="JUNIO" <? if($_POST["mes_nac"]=="JUNIO"):?> selected="selected"<? endif;?>>JUNIO</option>
                                        <option value="JULIO" <? if($_POST["mes_nac"]=="JULIO"):?> selected="selected"<? endif;?>>JULIO</option>
                                        <option value="AGOSTO" <? if($_POST["mes_nac"]=="AGOSTO"):?> selected="selected"<? endif;?>>AGOSTO</option>
                                        <option value="SEPTIEMBRE" <? if($_POST["mes_nac"]=="SEPTIEMBRE"):?> selected="selected"<? endif;?>>SEPTIEMBRE</option>
                                        <option value="OCTUBRE" <? if($_POST["mes_nac"]=="OCTUBRE"):?> selected="selected"<? endif;?>>OCTUBRE</option>
                                        <option value="NOVIEMBRE" <? if($_POST["mes_nac"]=="NOVIEMBRE"):?> selected="selected"<? endif;?>>NOVIEMBRE</option>
                                        <option value="DICIEMBRE" <? if($_POST["mes_nac"]=="DICIEMBRE"):?> selected="selected"<? endif;?>>DICIEMBRE</option>
									</select>
									Mes
								</div>
								<div style="width:50px;float:right">
									<select class="text_f" name="dia_nac">
		                                    <option value="">DIA</option>
											<?php
													$dia_n=1;
													while($dia_n<=31)
													{
											?>
														<option value="<?=$dia_n?>" <? if($_POST["dia_nac"]==$dia_n){?> selected="selected"<?};?>><?=$dia_n?></option>
											<?php
														$dia_n++;
													}
											?>
											</select>
									Dia
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Direccion de Residencia</label>
							<input type="text" name="direccion" size="35" value="<?=$_POST['direccion']?>"/>
						</td>
					</tr>	
					<tr>
						<td colspan="2">
							<label>Envieme correspondencia Digital</label>
							<input type="radio" name="corres" value="digital" <?if($corres=='digital'){echo "checked";} ?> checked="checked"/>
							<label>Envieme correspondencia en F&iacute;sico</label>
							<input type="radio" name="corres" value="fisico" <?if($corres=='fisico'){echo "checked";} ?>/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Direccion oficina</label>
							<input type="text" name="direccion_of" size="35" value="<?=$_POST['direccion_of']?>"/>
						</td>
						<td>
							<label>Ciudad</label>
							<input type="text" name="ciudad" size="30" value="<?=$_POST['ciudad']?>"/>
						</td>
					</tr>	
					<tr>
						<td>
							<label>Barrio</label>
							<input type="text" name="barrio" size="35" value="<?=$_POST['barrio']?>"/>
						</td>
						<td>
							<label>Departamento</label>
							<input type="text" name="depto" size="23" value="<?=$_POST['depto']?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<div style="width:50px;float:left">Tel&eacute;fono</div>
							<div style="float:right;color:#00ADEE;font-size:0.8em;margin:0 66px 0 0;//margin:0 35px 0 0">
								<input type="text" name="telefono" size="20" value="<?=$telefono?>"/>
								<div>S&oacute;lo N&uacute;mero, sin (.) (-) ( )</div>	
							</div>
						</td>
						<td>
							<div style="width:50px;float:left">Celular</div>
							<div style="float:right;color:#00ADEE;font-size:0.8em;margin:0 50px 0 0;//margin:0 25px 0 0">
								<input type="text" name="celular" size="20" value="<?=$_POST['celular']?>"/>
								<div>S&oacute;lo N&uacute;mero, sin (.) (-) ( )</div>	
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>E-mail</label>
							<input type="text" name="mail" size="35" value="<?=$_POST['mail']?>"/>
						</td>
					</tr>	
					<tr>
						<td colspan="2">
							<label>Comentarios</label>
							<textarea rows="5" name="coment" cols="65"><?=$_POST['coment']?></textarea>
						</td>
					</tr>	
                    <tr>
                    	<td  class="titulos">
                    		Quiero cambiar mi actual medio de pago.
                    	</td>
                    	<td>
                    		&nbsp;
                    	</td>
                    </tr>
                    <tr>
                    	<td colspan="2" style="color:#00ADEE">
                    		No requiere Firma
                    	</td>
                    </tr>
                    <tr>
                    	<td valign="top">
                    		<table>
                    			<tr>
                    				<td>
                    					<input type="radio" name="tipo" value="credito" <?if($_POST['tipo'] == 'credito'){echo "checked";} ?> checked> Autorizo debitar de mi Tarjeta de Cr&eacute;dito
                    				</td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<label>Tarjeta:</label>
                    					 <select class="text_f cajaf4" name="tarjeta">
										<option value="">Escoja su tarjeta de cr&eacute;dito</option>
                                        <option value="Visa" <? if($_POST["tarjeta"]=="Visa"):?> selected="selected"<? endif;?>>Visa</option>
                                        <option value="Dinners" <? if($_POST["tarjeta"]=="Dinners"):?> selected="selected"<? endif;?>>Dinners</option>
                                        <option value="American" <? if($_POST["tarjeta"]=="American"):?> selected="selected"<? endif;?>>American</option>
                                        <option value="Credencial" <? if($_POST["tarjeta"]=="Credencial"):?> selected="selected"<? endif;?>>Credencial</option>
                                        <option value="Master Card" <? if($_POST["tarjeta"]=="Master Card"):?> selected="selected"<? endif;?>>Master Card</option>
									</select>
                    				</td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<label>Banco:</label>
                    					 <select class="text_f cajaf3" name="banco">
										<option value="">Escoja su entidad bancaria</option>
                                        <option value="AV Villas" <? if($_POST["banco"]=="AV Villas"):?> selected="selected"<? endif;?>>AV Villas</option>
                                        <option value="Bancolombia" <? if($_POST["banco"]=="Bancolombia"):?> selected="selected"<? endif;?>>Bancolombia</option>
                                        <option value="Banco de Bogota" <? if($_POST["banco"]=="Banco de Bogota"):?> selected="selected"<? endif;?>>Banco de Bogot&aacute;</option>
                                        <option value="BBVA" <? if($_POST["banco"]=="BBVA"):?> selected="selected"<? endif;?>>BBVA</option>
                                        <option value="City Bank" <? if($_POST["banco"]=="City Bank"):?> selected="selected"<? endif;?>>City Bank</option>
                                        <option value="Colmena" <? if($_POST["banco"]=="Colmena"):?> selected="selected"<? endif;?>>Colmena</option>
                                        <option value="Colpatria" <? if($_POST["banco"]=="Colpatria"):?> selected="selected"<? endif;?>>Colpatria</option>
                                        <option value="Credito" <? if($_POST["banco"]=="Credito"):?> selected="selected"<? endif;?>>Cr&eacute;dito</option>
                                        <option value="HSBC" <? if($_POST["banco"]=="HSBC"):?> selected="selected"<? endif;?>>HSBC</option>
                                        <option value="Lloyds" <? if($_POST["banco"]=="Lloyds"):?> selected="selected"<? endif;?>>Lloyds</option>
                                        <option value="Megabanco" <? if($_POST["banco"]=="Megabanco"):?> selected="selected"<? endif;?>>Megabanco</option>
                                        <option value="Popular" <? if($_POST["banco"]=="Popular"):?> selected="selected"<? endif;?>>Popular</option>
                                        <option value="Santander" <? if($_POST["banco"]=="Santander"):?> selected="selected"<? endif;?>>Santander</option>
                                        <option value="Sudameris" <? if($_POST["banco"]=="Sudameris"):?> selected="selected"<? endif;?>>Sudameris</option>
                                        <option value="Superior" <? if($_POST["banco"]=="Superior"):?> selected="selected"<? endif;?>>Superior</option>
                                        <option value="Tequendama" <? if($_POST["banco"]=="Tequendama"):?> selected="selected"<? endif;?>>Tequendama</option>
									</select>
                    				</td>
                    			</tr>
                    			<tr>
	                    			<td>
										<div style="width:50px;float:left">Numero</div>
										<div style="float:right;color:#00ADEE;font-size:0.8em;margin:0 50px 0 0;//margin:0 40px 0 0">
											<input type="text" name="numero" size="28" value="<?=$_POST['numero']?>"/>
											<div>S&oacute;lo N&uacute;mero, sin (.) (-) ( )</div>	
										</div>
									</td>
                    			</tr>
                    			<tr>
                    				<td align="left">
                    					<div style="width:50px;float:left">Vence</div>
                    					<div style="float:right;margin:0 80px 0 0;//margin:0 50px 0 0">
	                    					<div style="width:80px;float:right;text-align:center;margin:0 60px 0 0;//margin:0 80px 0 0">
		                    					<select class="text_f2" name="mes" style="margin:0 0 0 5px">
			                                        <option value="ENERO" <? if($_POST["mes"]=="ENERO"):?> selected="selected"<? endif;?>>ENERO</option>
			                                        <option value="FEBRERO" <? if($_POST["mes"]=="FEBRERO"):?> selected="selected"<? endif;?>>FEBRERO</option>
												    <option value="MARZO" <? if($_POST["mes"]=="MARZO"):?> selected="selected"<? endif;?>>MARZO</option>
			                                        <option value="ABRIL" <? if($_POST["mes"]=="ABRIL"):?> selected="selected"<? endif;?>>ABRIL</option>
			                                        <option value="MAYO" <? if($_POST["mes"]=="MAYO"):?> selected="selected"<? endif;?>>MAYO</option>
			                                        <option value="JUNIO" <? if($_POST["mes"]=="JUNIO"):?> selected="selected"<? endif;?>>JUNIO</option>
			                                        <option value="JULIO" <? if($_POST["mes"]=="JULIO"):?> selected="selected"<? endif;?>>JULIO</option>
			                                        <option value="AGOSTO" <? if($_POST["mes"]=="AGOSTO"):?> selected="selected"<? endif;?>>AGOSTO</option>
			                                        <option value="SEPTIEMBRE" <? if($_POST["mes"]=="SEPTIEMBRE"):?> selected="selected"<? endif;?>>SEPTIEMBRE</option>
			                                        <option value="OCTUBRE" <? if($_POST["mes"]=="OCTUBRE"):?> selected="selected"<? endif;?>>OCTUBRE</option>
			                                        <option value="NOVIEMBRE" <? if($_POST["mes"]=="NOVIEMBRE"):?> selected="selected"<? endif;?>>NOVIEMBRE</option>
			                                        <option value="DICIEMBRE" <? if($_POST["mes"]=="DICIEMBRE"):?> selected="selected"<? endif;?>>DICIEMBRE</option>
												</select>
												Mes
											</div>
											
	                    					<div style="width:50px;float:right;text-align:center;">
											 <select class="text_f" name="ano" style="margin:0 5px 0 0px">
		                                    <option value="">A&Ntilde;O</option>
											<?php
													$ano=date("Y");
													while($ano<=2030)
													{
											?>
														<option value="<?=$ano?>" <? if($_POST["ano"]==$ano):?> selected="selected"<? endif;?>><?=$ano?></option>
											<?php
														$ano++;
													}
											?>
											</select>
											A&ntilde;o
											</div>
										</div>
                    				</td>
                    			</tr>
                    		</table>
                    	</td>
                    	<td valign="top"> <!-- Segunda tablita de los bancos -->
                    		<table>
                    			<tr>
                    				<td>
                    					<input type="radio" name="tipo" value="bancaria" <?if($_POST['tipo'] == 'bancaria'){echo "checked";} ?>> Autorizo debitar de mi Cuenta Bancaria
                    				</td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<label>Tipo de Cuenta:</label>
                    					<select class="text_f cajaf7" name="tipo_cuenta">
											<option value="">Seleccione</option>
	                                        <option value="1" <? if($_POST["tipo_cuenta"]==1):?> selected="selected"<? endif;?>>Corriente</option>
	                                        <option value="2" <? if($_POST["tipo_cuenta"]==2):?> selected="selected"<? endif;?>>Ahorros</option>
										</select>
                    				</td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<label>Banco:</label>
                    					 <select class="text_f cajaf3" name="banco_2">
										<option value="">Escoja su entidad bancaria</option>
                                        <option value="AV Villas" <? if($_POST["banco"]=="AV Villas"):?> selected="selected"<? endif;?>>AV Villas</option>
                                        <option value="Bancolombia" <? if($_POST["banco"]=="Bancolombia"):?> selected="selected"<? endif;?>>Bancolombia</option>
                                        <option value="Banco de Bogota" <? if($_POST["banco"]=="Banco de Bogota"):?> selected="selected"<? endif;?>>Banco de Bogot&aacute;</option>
                                        <option value="BBVA" <? if($_POST["banco"]=="BBVA"):?> selected="selected"<? endif;?>>BBVA</option>
                                        <option value="City Bank" <? if($_POST["banco"]=="City Bank"):?> selected="selected"<? endif;?>>City Bank</option>
                                        <option value="Colmena" <? if($_POST["banco"]=="Colmena"):?> selected="selected"<? endif;?>>Colmena</option>
                                        <option value="Colpatria" <? if($_POST["banco"]=="Colpatria"):?> selected="selected"<? endif;?>>Colpatria</option>
                                        <option value="Credito" <? if($_POST["banco"]=="Credito"):?> selected="selected"<? endif;?>>Cr&eacute;dito</option>
                                        <option value="HSBC" <? if($_POST["banco"]=="HSBC"):?> selected="selected"<? endif;?>>HSBC</option>
                                        <option value="Lloyds" <? if($_POST["banco"]=="Lloyds"):?> selected="selected"<? endif;?>>Lloyds</option>
                                        <option value="Megabanco" <? if($_POST["banco"]=="Megabanco"):?> selected="selected"<? endif;?>>Megabanco</option>
                                        <option value="Popular" <? if($_POST["banco"]=="Popular"):?> selected="selected"<? endif;?>>Popular</option>
                                        <option value="Santander" <? if($_POST["banco"]=="Santander"):?> selected="selected"<? endif;?>>Santander</option>
                                        <option value="Sudameris" <? if($_POST["banco"]=="Sudameris"):?> selected="selected"<? endif;?>>Sudameris</option>
                                        <option value="Superior" <? if($_POST["banco"]=="Superior"):?> selected="selected"<? endif;?>>Superior</option>
                                        <option value="Tequendama" <? if($_POST["banco"]=="Tequendama"):?> selected="selected"<? endif;?>>Tequendama</option>
									</select>
                    				</td>
                    			</tr>
                    			<tr>
	                    			<td>
										<div style="width:50px;float:left">Numero</div>
										<div style="float:right;color:#00ADEE;font-size:0.8em">
											<input type="text" name="numero_otro" size="28" value="<?=$_POST['numero_otro']?>"/>
											<div>S&oacute;lo N&uacute;mero, sin (.) (-) ( )</div>	
										</div>
									</td>
                    			</tr>
                    		</table>
                    	</td>
                    </tr>
                    <tr>
                    	<td colspan="2" align="right">
                    		<input type="submit" value="Enviar" name="enviar">
                    		<input type="reset" value="Borrar">
                    	</td>
                    </tr>
                </table>
                <table width="100%">
                	<tr>
                		<td>
                			<h2 style="color:#009EE0">Actualiza ya tus datos y participa en la rifa de una espectacular grabadora mp3.</h2>
                			<p><b>Condiciones y Restricciones</b></p>
                			<ol>
                				<li>Aplica exclusivamente para Amigos SOS que se encuentren activos y que hallan actualizado sus datos dentro de las fechas estipuladas </li>
                				<li>El numero asignado al participante ser&aacute; personal e intransferible, susceptible a verificaci&oacute;n</li>
                				<li>Las personas que actualicen datos fuera de las fechas estipuladas no participar&aacute;n. </li>
                				<li>El premio no podr&aacute; ser cambiado ni canjeado por dinero</li>
                				<li>El ganador deber&aacute; suministrar a Aldeas infantiles SOS Colombia una fotocopia de su c&eacute;dula de ciudadan&iacute;a para verificar su identidad.</li>
                				<li>Si el premio no cae con los 4 &uacute;ltimos d&iacute;gitos de la loter&iacute;a quedara acumulado para el pr&oacute;ximo sorteo</li>
                			</ol>
                		</td>
                	</tr>
                </table>
         </form>
</div>
</div>
</div>
</body>
</html>