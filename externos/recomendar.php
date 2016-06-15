<?
/*
 * Recomendar a un amigo
 * @author Farez Prieto
 * @date 17 de noviembre de 2010
 */
require("../config/configuracion.php");
require("../config/conexion_2.php");
global $db;
$errores='';
if(isset($_POST['enviar_x']))
{
	extract($_POST);
	//valido campos
	if(empty($tu_nombre))
	{
		$errores	=	"Debes escribir tu nombre";
	}
	elseif(empty($tu_mail))
	{
		$errores	=	"Debes escribir tu correo";
	}
	elseif(!empty($tu_mail) and !ereg("([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+",$tu_mail))
	{
		$errores	=	"La sintaxis de tu correo es erronea";
	}
	elseif(empty($nombre_amigo))
	{
		$errores	=	"Debes escribir el nombre de tu amigo";
	}
	elseif(empty($mail_amigo))
	{
		$errores	=	"Debes escribir el correo de tu amigo";
	}
	elseif(!empty($mail_amigo) and !ereg("([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+",$mail_amigo))
	{
		$errores	=	"La sintaxis del correo de tu amigo es erronea";
	}
	else
	{
		//procedo a enviar el mail
		$asunto		=	"Te han recomendado una página web";
		$headers		= "MIME-Version: 1.0\r\n";
		$headers 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$mensaje	=	"";
		$para		=	$mail_amigo;
		if(mail($para,$asunto,$mensaje,$headers))
		{
			echo "<script>alert('Se ha enviado su mensaje con Exito');window.parent.closeShadow();</script>";
		}
		else
		{
			echo "<script>alert('El mensaje no pudo ser enviado');window.parent.closeShadow();</script>";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BULEVAR</title>
<!-- <link href="../css/estilos.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<style>
body{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF; background-color:#000;}
	#amigo{width:500px; float:left; height:300px; background:url(../images/diseno/fondorec.jpg) no-repeat top left; background-color:#000;}
#formamigo{width: 350px; float:right; margin:110px 20px 0 0;}
#errores{width:350px; float:left; margin:5px 0;}
.damigo{width:350px; float:left; margin:5px 0 8px 0; border-bottom:#09C solid 1px;}
.damigo2{width:350px; float:left; margin:5px 0;}
	.datosa{width:200px; float:right; margin:2px 0 2px 10px;}
		.datosa input{width:200px; height:20px;}
	.nombre_cont2{width:140px; float:left; color:#fff;  margin:3px 0 2px 0; font-size:13px;}
	#enviar{width:95px; float:right; margin:10px;}
</style>
</head>

<body onload="MM_preloadImages('../images/diseno/enviar2.png')">
<center>
<div id="amigo">
 	<div id="formamigo">
	 	<form method="post">
	    	<div id="errores">
	    		<?=$errores ?>
	    	</div>
	        <div class="damigo">
	        	<div class="nombre_cont2">Tu Nombre</div>
	   			<div class="datosa"><input name="tu_nombre" type="text" value="<?=$tu_nombre?>"/></div>
	   			<div class="nombre_cont2">Tu Email</div>
	   			<div class="datosa"><input name="tu_mail" type="text" value="<?=$tu_mail?>"/></div>
	        </div>
	        <div class="damigo2">
	        	<div class="nombre_cont2">Nombre de tu Amigo</div>
	   			<div class="datosa"><input name="nombre_amigo" type="text" value="<?=$nombre_amigo?>"/></div>
	   			<div class="nombre_cont2">Email de tu Amigo</div>
	   			<div class="datosa"><input name="mail_amigo" type="text" value="<?=$mail_amigo?>"/></div>
	        </div>
	        <div id="enviar">
	        	<a style="cursor:pointer" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','../images/diseno/enviar2.png',1)">
	        		<input type="image" src="../images/diseno/enviar1.png" name="enviar" width="92" height="18" border="0" id="Image1" />
	        	</a>
	        </div>
        </form>
    </div>
 </div>
 </center>
</body>
</html>
