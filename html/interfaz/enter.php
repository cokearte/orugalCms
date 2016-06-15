<?
session_start();
if(isset($_POST['entrar_x']))
{
	$_SESSION['mayor']	=	1;
	header("location:index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_NOMBRE_EMPRESA?></title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
</head>

<body onload="MM_preloadImages('images/diseno/enter2.png','images/diseno/leave2.png')">
<div id="navegador">
	<div id="permiso">
    	<div id="logop"><img src="images/diseno/logo.png" width="230" height="78" /></div>
        <div id="textpermiso">
        	<h3>WARNING: This website contains explicit adult material.</h3><br />
            You may only enter this Website if you are at least 18 years of age, or at least the age of majority in the jurisdiction where you reside or from which you access this Website. If you do not meet these requirements, then you do not have permission to use the Website.  
        </div>
        <div id="btnpermiso">
        	<div id="entrar">
        		<form action="" method="post">
	        		<a style="cursor:pointer" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/diseno/enter2.png',1)">
	        			<input type="image" src="images/diseno/enter1.png" name="entrar" width="116" height="71" border="0" id="Image2" />
	        		</a>
        		</form>
        	</div>
            <div id="leave">
            	<a href="http://www.wikipedia.org/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/diseno/leave2.png',1)">
            		<img src="images/diseno/leave1.png" name="Image3" width="116" height="76" border="0" id="Image3" />
            	</a>
            </div>
        </div>
        <div id="seguridad">Please email soporte@teenlatin.com if you are having problems with the site.
Cookies must be enabled. <a href="http://www.parentalcontrolbar.org/" target="_blank" style="color:#fff">Parental Control</a></div>
  </div>
</div>
</body>
</html>
