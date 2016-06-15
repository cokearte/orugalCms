<?
class ClassMail {

  var $To;					//Destinatario del correo
  var $Subject;             //Asunto
  var $Content;				//Contenido
  var $From;				//Persona que envia el correo
  var $XSender;				//Correo desde donde se envia
  var $XMailer;				//Mailer
  var $XPriority;			//Numero de prioridad
  var $ReturnPath;			//Path de retorno para errores
  var $CC;					//Copia 
  var $BCC;					//Copia Ciega
  var $ContentType;			//Tipo de contenido(Mime type)

  function ClassMail(){
	$this->To			= "";
	$this->Subject		= "";             
	$this->Content		= "";				
	$this->From			= "";
	$this->XSender		= "";
	$this->XMailer		= "PHP";
	$this->XPriority	= 3;	//Prioridad 3 es Normal 1 es Alta
	$this->ReturnPath	= "";
	$this->CC			= "";
	$this->BCC			= "";
	$this->ContentType	= "text/html"; 
	//-----------Algunos tipos de contenido(Mime type) soportados por Internet Explorer-----------------
		//text/richtext 
		//text/html 
		//audio/x-aiff 
		//audio/basic 
		//audio/wav 
		//image/gif 
		//image/jpeg 
		//image/pjpeg 
		//image/tiff 
		//image/x-png 
		//image/x-xbitmap 
		//image/bmp 
		//image/x-jg 
		//image/x-emf 
		//image/x-wmf 
		//video/avi 
		//video/mpeg 
		//application/postscript 
		//application/base64 
		//application/macbinhex40 
		//application/pdf 
		//application/x-compressed 
		//application/x-zip-compressed 
		//application/x-gzip-compressed 
		//application/java 
		//application/x-msdownload 
	//-----------Algunos otro de contenido(Mime type)-----------------
		//text/plain; charset="US-ASCII"
		//text/plain; charset="iso-8859-1"
		//text/plain; charset=iso-8859-1; format=flowed
	}//Fin del constructor

  function SendMail () {
	$Header  = "From: "			. $this->From			. "<" . $this->XSender. ">\n";
	$Header .= "X-Sender: "		. $this->XSender		. "\n";
	$Header .= "X-Mailer: "		. $this->XMailer		. "\n"; 
	$Header .= "X-Priority: "	. $this->XPriority		. "\n"; 
	$Header .= "Return-Path: "	. $this->ReturnPath		. "\n";
	$Header .= "cc: "			. $this->CC				. "\n"; 
	$Header .= "bcc: "			. $this->BCC			. "\n"; 
	$Header .= "Content-Type: " . $this->ContentType	. "\n";
	return mail($this->To, $this->Subject, $this->Content, $Header);
    }//Fin de function SendMail

  }//Fin de ClassMail
    
?>