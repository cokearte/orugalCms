<?php
/*
*Archivo de Configuracion del sistema
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
define('_NOMBRE_EMPRESA'	                                ,'Bancolombia OPEN');			//Url desde el navegador


			

//BASE DE DATOS
//Nombre del hosting
define('_HOST'											,'localhost');
//Usuario base de datos
define('_USER'											,'root');
//Contraseña del usuario
define('_PASS'											,'0000');
//base de datos
define('_DB'											,'veerkamp');

//DATOS DE ENVIO DE CORREOS
define('_DIR_PLUGIN'									,'core/phpmailer/');
define('_MAILER'										,'mail');
define('_HOST_MAIL'										,'mail.paxzu.com');
define('_SMTP_AUTH'										,true);
define('_SMTP_USER'										,'farez@paxzu.com');
define('_SMTP_PASS'										,'Jg$E3D+u');
define('_ES_HTML'										,true);


/*TABLAS DE LA BASE DE DATOS*/
define('_TABLA_PRINCIPAL'								,'principal');



/*Menus*/
define('_PRINCIPAL'										,2);
define('_SECUNDARIO'									,2);
define('_PIE'											,2);

/*Mensajes de error*/
define('_MENSAJE_ERROR'									,'No se pudo realizar la consulta del query. Linea %s del archivo %s ');


//declaro el arreglo con  los tipos de nodo
$nodos[0]='Default';
$nodos[1]='Noticias';
$nodos[2]='Catalogo';
$nodos[3]='Galeria Img';
$nodos[4]='Aplicacion PHP';
$nodos[5]='Foro';

/*Aplicativos que son reelevantes*/
define('_REGISTRO'										,63);
define('_LOGIN'											,2);
define('_BUSCAR'										,89);
define('_CATALOGO'										,2);



?>