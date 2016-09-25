<?php
ini_set("display_errors",0);
session_start();
//$_SESSION['ingreso']	=	1;
//valido si se dio la orden de cerrar session
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
	echo "<script>document.location='index.php'</script>";
}
if(isset($_GET['quit']))
{
	unset($_SESSION['ingreso']);
	echo "<script>document.location='index.php'</script>";
}
require('core/PHPPaging.lib.php');
//inicializa el archivo de configuracion interna del portal
require_once('config/configuracion.php');
//inicializa la conecion
include('config/conexion.php');
//Clase de las funciones
require_once('core/funciones.class.php');	
//clase que controla el funcionamiento
require_once('core/core.class.php');

//verifico el nodo al cual se esta haciendo referencia
$id		=	(isset($_GET['id']))?$_GET['id']:1;
//objeto de la clase funciones
$funciones	=	new Funciones();
//objeto de la clase core
$core	=	new Core();

//genera las urls amigables
$htaccess = $funciones->automaticHtaccess();
//muestro los banners del home
if($id==1)
{
//	$banners	=	$funciones->banners($id,4);//carga los banners del home
}
//var_dump($banners);
if(isset($_GET['tipo']))
{
	$tipo	=	$_GET['tipo'];
}
else
{
	$tipo	=	'';
}

//$titulo_pagina	=	$funciones->obtenerTitulo($id);
//busca la miga recursiva
	
$contenido			=	$core->contenido($id,$tipo);
$tipo				=	($tipo=='')?$funciones->obtenerTipoNodo($id):$tipo;

if(isset($_GET['hijo']))
{
	$info_id	=	$funciones->infoId($_GET['hijo']);
}
else
{
	
	if(isset($_GET["visitada"])){
		//echo $id;
		//$info_id	=	$funciones->infoId($id);
		$info_id        =       $funciones->consultaUniversal("principal"," id_padre=$id and id=".$_GET["visitada"]." order by fecha desc");
	}else{
		if($id!=14){
			$info_id        =       $funciones->infoId($id);
		}else{
			$info_id	=	$funciones->consultaUniversal("principal"," id_padre=$id order by fecha desc");
		}
	}
}
$datos			=	array();
$queryImagenesHome	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre=445 AND visible=1"));
//$queryImagenesHome	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre=445 AND visible=1 ORDER BY RAND() LIMIT 1"));

$noticias			=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre IN(1205,1206) AND eliminado=0 AND visible=1 AND promocion=1 ORDER BY fecha DESC"));
$frase				=	$funciones->infoId(1218);
//como esta es una página tipo parallax y no tiene páginas internas sino solo info hacia abajo debo consultar todo en esta seccion

//experiencia
$expe                       =   $funciones->infoId(1205);

//bievenidos
$bienvenido                 =   $funciones->infoId(1204);

//quienes somos
$quienesSomos				=	$funciones->infoId(13);

//menu
$menu   					=	$funciones->obtenerListado(1190);

//galeria
$galeria						=	$funciones->obtenerListado(1195);

//Equpo
$equipo 					=	$funciones->obtenerListado(1199);

//Equpo
//$listNoticias 				=	$funciones->obtenerListado(1235);

$primeraNot                   =   $db->GetAll(sprintf("SELECT MAX(id) as id FROM principal WHERE id_padre IN(1235) AND eliminado=0 AND visible=1 ORDER BY id DESC"));   
//primera noticia
if(isset($_GET['idNoticia']))
{
    $listNoticias                   =   $db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre IN(1235) AND eliminado=0 AND visible=1 AND id =%s ORDER BY id DESC",$_GET['idNoticia']));
}
else
{
    $listNoticias                   =   $db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre IN(1235) AND eliminado=0 AND visible=1 AND id =%s ORDER BY id DESC",$primeraNot[0]['id']));
}
$ssql                           = sprintf("SELECT * FROM principal WHERE id_padre IN(1235) AND eliminado=0 AND visible=1 ORDER BY id DESC");
$paging=new PHPPaging;
$paging->paginasAntes(6);
$paging->paginasDespues(6);
if($_GET['ver'])
{
    $e_ssql=mysql_query($ssql);
    $numver=mysql_num_rows($e_ssql);
}
else
{
    $numver=2;
}

$paging->porPagina($numver);
$paging->agregarConsulta($ssql);
$paging->ejecutar();
$paging->linkAgregar = "#enterate";
if(!$paging->numTotalRegistros())
 {
    $no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
}

$links = $paging->fetchNavegacion();


$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}

if ($tablet_browser > 0) {
// Si es tablet has lo que necesites
   include(_PLANTILLAS.'interfaz/index.html');
}
else if ($mobile_browser > 0) {
// Si es dispositivo mobil has lo que necesites
   include(_PLANTILLAS.'interfaz/index.html');
}
else {
// Si es ordenador de escritorio has lo que necesites
   include(_PLANTILLAS.'interfaz/index.html');
} 

?>