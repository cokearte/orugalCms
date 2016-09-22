<?php
/*
*Archivo de Configuracion del sistema
* @author Farez Prieto
* @date 21 de Septiembre de 2010
*/

//obtengo la ruta absoluta
$path 			= getcwd();
$ruta_absoluta	=	str_replace("\\","/",$path)."/";
//obtebgo la carpeta de la web
$path_inicial	=	pathinfo(__FILE__);
//saco la ruta
$var = explode('\\',$path_inicial['dirname']);
//cuento las posiciones del arreglo
$tamano_array	=	count($var);
//resto la ultima posicion para sacar la carpeta correspondiente
$tamano_array_2	=	$tamano_array - 2;
//creo la ruta web
$ruta_web		=	'http://'.$_SERVER['SERVER_ADDR']."/".$var[$tamano_array_2]."/";

//RUTAS ABSOLUTAS Y RELATIVAS																
define('_RUTA_WEB'                                       	,$ruta_web);			//Url desde el navegador
define('_RUTA_ABSOLUTA'										,$ruta_absoluta);		//Ruta relativa del portal en el disco del servidor

//Carpetas
define('_PLANTILLAS'	                                 	,$ruta_absoluta.'html/');			//Url desde el navegador
define('_NOMBRE_EMPRESA'	                                ,'Orugal');			//Url desde el navegador
define('_DOMINIO'	                     		           ,'http://192.168.1.14/CMSorugal/');			//local
//define('_DOMINIO'	                     		           ,'http://192.168.0.12:8081/orugalCms/');			//local


define('_ENTORNO',											"desarrollo");//desarrollo - produccion
define('_LOGO',												_DOMINIO."images/diseno/logo.png");//logo
define('_BANNER_ADMIN',										false);
define('_MENSAJE_FAIL',										"Perd&oacute;n, pero esta es zona restringida");



define('_ID_AFILIADOS',1676);//en menu principal

//BASE DE DATOS
//Nombre del hosting
define('_HOST'											,'localhost');
//Usuario base de datos
define('_USER'											,'root');
//Contraseña del usuario
define('_PASS'											,'');
//base de datos
define('_DB'											,'orugalcms');

//DATOS DE ENVIO DE CORREOS
define('_DIR_PLUGIN'									,'core/phpmailer/');
define('_MAILER'										,'mail');
define('_HOST_MAIL'										,'mail.wannabe.com.co');
define('_SMTP_AUTH'										,true);
define('_SMTP_USER'										,'info@wannabe.com.co');
define('_SMTP_PASS'										,'Jg$E3D+u');
define('_ES_HTML'										,true);
//Correo del administrador
define('_MAIL_ADMIN'									,'info@wannabe.com.co');


/*TABLAS DE LA BASE DE DATOS*/
define('_TABLA_PRINCIPAL'								,'principal');



/*Menus*/
define('_PRINCIPAL'										,10);
define('_MARCAS'										,15);
define('_SECUNDARIO'									,2);
define('_PIE'											,2);

/*Mensajes de error*/
define('_MENSAJE_ERROR'									,'No se pudo realizar la consulta del query. Linea %s del archivo %s ');

/*Aplicativos que son reelevantes*/
define('_REGISTRO'										,63);
define('_LOGIN'											,2);
define('_BUSCAR'										,89);
define('_CATALOGO'										,2);
/*Tener en cuenta esta constante en caso de que sea instale un catalogo de productos*/
define('_ATRIBUTOS'										,209);

//tipos de contenido especiales
define('_TIPO_PRODUCTO'									,10);
define('_TIPO_CATALOGO'									,3);
define('_TIPO_CATEGORIA'								,2);
define('_TIPO_SUBCATEGORIA'								,8);
define('_TIPO_LINEA'									,9);
define('_TIPO_DESCARGA'									,11);
define('_TIPO_ARCHIVO'									,12);
define('_TIPO_GALERIA_VIDEO'							,14);
define('_TIPO_VIDEO'									,15);
define('_TIPO_SUBNOTICIA'								,16);
define('_TIPO_NOTICIA'									,1);
define('_TIPO_TITULARES'								,17);
define('_TIPO_TITULAR'									,18);
define('_TIPO_JUGADORES'								,19);
define('_TIPO_JUGADOR'									,20);
define('_TIPO_GALERIA_IMAGEN'							,4);
define('_TIPO_IMAGEN'									,21);
define('_TIPO_ATRIBUTO'									,22);
define('_TIPO_SUBATRIBUTO'								,23);
define('_TIPO_TIENDA'									,24);
define('_TIPO_SUBTIENDA'								,25);
define('_TIPO_ACADEMIA'									,26);
define('_TIPO_SUBACADEMIA'								,27);
define('_TIPO_OFERTERO'									,28);
define('_TIPO_SUBOFERTERO'								,29);
define('_TIPO_EVENTOS'									,30);
define('_TIPO_SUBEVENTOS'								,31);
define('_TIPO_VACANTES'									,32);
define('_TIPO_SUBVACANTES'								,33);
define('_TIPO_DEFAULT2'									,34);
?>
