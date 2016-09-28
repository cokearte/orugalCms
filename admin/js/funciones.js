




function campos(accion)
{
	document.getElementById('antetitulo').style.display = accion;
	document.getElementById('titulo').style.display = accion;
	document.getElementById('subtitulo').style.display = accion;
	document.getElementById('resumen').style.display = accion;
	document.getElementById('descripcion').style.display = accion;
	document.getElementById('adjunto').style.display = accion;
	document.getElementById('imagen').style.display = accion;
	document.getElementById('imagen2').style.display = accion;
	document.getElementById('imagen3').style.display = accion;
	document.getElementById('imagen4').style.display = accion;
	document.getElementById('imagen5').style.display = accion;
	document.getElementById('pie_imagen').style.display = accion;
	document.getElementById('imagen_home').style.display = accion;
	document.getElementById('autor').style.display = accion;
	document.getElementById('mail_autor').style.display = accion;
	document.getElementById('link').style.display = accion;
	document.getElementById('tipo_link').style.display = accion;
	//campos del producto
	//document.getElementById('producto').style.display = accion;
	document.getElementById('marca').style.display = accion;
	document.getElementById('codproducto').style.display = accion;
	document.getElementById('partefabricante').style.display = accion;
	document.getElementById('parteproducto').style.display = accion;
	document.getElementById('keywords').style.display = accion;
	document.getElementById('alto').style.display = accion;
	document.getElementById('ancho').style.display = accion;
	document.getElementById('largo').style.display = accion;
	document.getElementById('profundidad').style.display = accion;
	document.getElementById('puntos').style.display = accion;
	document.getElementById('canje').style.display = accion;
	document.getElementById('puntoscanje').style.display = accion;
	document.getElementById('destacado').style.display = accion;
	document.getElementById('novedad').style.display = accion;
	document.getElementById('imagen1_preview').style.display = accion;
	document.getElementById('asignar').style.display = accion;
	document.getElementById('atributos').style.display = accion;
	//document.getElementById('titulo_atributos').style.display = accion;
	document.getElementById('relacionados').style.display = accion;
	document.getElementById('descriptivo').style.display = accion;
	document.getElementById('categorias_asign').style.display = accion;
	document.getElementById('promocion').style.display = accion;
	document.getElementById('precio_normal').style.display = accion;
	document.getElementById('precio_oferta').style.display = accion;
	document.getElementById('iva').style.display = accion;
	
	document.getElementById('mostrar_imagen2').style.display = accion;
	document.getElementById('mostrar_imagen3').style.display = accion;
	document.getElementById('mostrar_imagen4').style.display = accion;
	document.getElementById('mostrar_imagen5').style.display = accion;

	document.getElementById('direccion').style.display = accion;
	document.getElementById('telefono').style.display = accion;
	document.getElementById('telefono2').style.display = accion;
	document.getElementById('mail').style.display = accion;
	document.getElementById('horarios').style.display = accion;
	document.getElementById('notas').style.display = accion;
	document.getElementById('mapa').style.display = accion;
	document.getElementById('seo').style.display = accion;



	document.getElementById('linkFacebook').style.display = accion;
	document.getElementById('linkTwitter').style.display = accion;
	document.getElementById('linkInstagram').style.display = accion;
	document.getElementById('linkGooglePlus').style.display = accion;
	document.getElementById('linkYoutube').style.display = accion;
	document.getElementById('linkLinkedin').style.display = accion;
	
	document.getElementById('horarioinicio').style.display =  accion;
	document.getElementById('horariofin').style.display =  accion;

	document.getElementById('permisos').style.display = accion;
	//document.getElementById('recom').style.display = accion;
	document.getElementById('fecha_form').style.display = accion;
	document.getElementById('multiImagen').style.display = accion;
	document.getElementById('url_amigable').style.display = '';
		
}
function tiposid(id)
{
	//si es tipo Noticias
	if(id == 0)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('antetitulo').style.display = '';
		document.getElementById('descripcion').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('mostrar_imagen2').style.display = '';
		document.getElementById('imagen3').style.display = '';
		document.getElementById('mostrar_imagen3').style.display = '';
		document.getElementById('imagen4').style.display = '';
		document.getElementById('mostrar_imagen4').style.display = '';
		document.getElementById('imagen5').style.display = '';
		document.getElementById('mostrar_imagen5').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';

		
	}
	//si es tipo reminiscencias
	else if(id	== 55)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//si es tipo subreminiscencias
	else if(id	== 56)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('mostrar_imagen2').style.display = '';
	}
	//si es tipo Noticias
	else if(id == 1)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		//document.getElementById('resumen').style.display = '';
		//document.getElementById('imagen').style.display = '';
		//document.getElementById('imagen1_preview').style.display = '';
	}
	//si es tipo Subcatalogo
	else if(id == 2)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('mostrar_imagen2').style.display = '';
	}
	//si es catalogo
	else if(id == 3)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		//document.getElementById('imagen').style.display = '';
		//document.getElementById('imagen1_preview').style.display = '';
	}
	//si es tipo galeria de imagenes
	else if(id == 4)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('multiImagen').style.display = '';
	}
	//si es tipo aplicacion PHP
	else if(id == 5)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('descripcion').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}
	//si es tipo home
	else if(id == 6)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('keywords').style.display = '';
		document.getElementById('telefono').style.display = '';
		document.getElementById('telefono2').style.display = '';
		document.getElementById('mail').style.display = '';
		document.getElementById('notas').style.display = '';
		document.getElementById('direccion').style.display = '';


		document.getElementById('linkFacebook').style.display = '';
		document.getElementById('linkTwitter').style.display = '';
		document.getElementById('linkInstagram').style.display = '';
		document.getElementById('linkGooglePlus').style.display = '';
		document.getElementById('linkYoutube').style.display = '';
		document.getElementById('linkLinkedin').style.display = '';
	}
	//si es subcategoria
	else if(id == 8)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		//document.getElementById('precio_normal').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('pie_imagen').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
		document.getElementById('seo').style.display = 'none';
	}
	//si es linea
	else if(id == 9)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('precio_normal').style.display =	'';
		document.getElementById('destacado').style.display = '';
	}
	//si es tipo Producto
	else if(id == 10)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('asignar').style.display = '';
		document.getElementById('categorias_asign').style.display = '';
		document.getElementById('alto').style.display = '';
		document.getElementById('promocion').style.display = '';
		document.getElementById('novedad').style.display = '';
		document.getElementById('destacado').style.display = '';
		document.getElementById('permisos').style.display = '';
		document.getElementById('marca').style.display = '';
		document.getElementById('canje').style.display = '';
		document.getElementById('puntoscanje').style.display = '';
	}
	//descarga de archivos
	else if(id == 11)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('descripcion').style.display = '';
	}
	//archivos
	else if(id == 12)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('resumen').style.display = '';
		//document.getElementById('descripcion').style.display = '';
	}
	
	//si es tipo aplicacion PHP administrativa
	else if(id == 13)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
	}
	//galeria video
	else if(id == 14)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('descripcion').style.display = '';
	}
	//video
	else if(id == 15)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		//document.getElementById('adjunto').style.display = '';
		document.getElementById('descripcion').style.display = '';
		document.getElementById('resumen').style.display = '';
		//document.getElementById('imagen').style.display = '';
		document.getElementById('descriptivo').style.display = '';
	}
	
	//subnoticia
	else if(id == 16)
	{
		campos('none');
		//document.getElementById('antetitulo').style.display = '';
		document.getElementById('titulo').style.display = '';
	}
	
	//Titulares
	else if(id == 17)
	{
		campos('none');
		//document.getElementById('antetitulo').style.display = '';
		document.getElementById('titulo').style.display = '';
		//document.getElementById('subtitulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		//document.getElementById('descripcion').style.display = '';
		document.getElementById('imagen').style.display = '';
		//document.getElementById('imagen_home').style.display = '';
		document.getElementById('autor').style.display = '';
		//document.getElementById('mail_autor').style.display = '';
		document.getElementById('link').style.display = '';
		//document.getElementById('tipo_link').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('fecha_form').style.display = '';
		//document.getElementById('adjunto').style.display = '';
	}
	//Titular
	else if(id == 18)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
	}
	//TIPO JUGADORES
	else if(id == 19)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		//document.getElementById('adjunto').style.display = '';
		//document.getElementById('imagen').style.display = '';
		//document.getElementById('descripcion').style.display = '';
		//document.getElementById('imagen1_preview').style.display = '';
	}
	//TIPO JUGADOR
	else if(id == 20)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('link').style.display = '';
	}
	//si es tipo imagen
	else if(id == 21)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('seo').style.display = 'none';
		document.getElementById('pie_imagen').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
		
	}
	//si es tipo atributo
	else if(id == 22)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//si es tipo subatributo
	else if(id == 23)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//tipo tiendas principal
	else if(id == 24)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//tipo subtienda
	else if(id == 25)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('resumen').style.display =  '';
	}	
	//academias
	else if(id == 26)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//subacademia
	else if(id ==27)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('imagen3').style.display = '';
		document.getElementById('imagen4').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('direccion').style.display =  '';
		document.getElementById('telefono').style.display =  '';
		document.getElementById('telefono2').style.display =  '';
		document.getElementById('mail').style.display =  '';
		document.getElementById('horarios').style.display =  '';
		document.getElementById('notas').style.display =  '';
		document.getElementById('mapa').style.display =  '';
		document.getElementById('adjunto').style.display =  '';
	}
	//ofertero	
	else if(id ==28)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('adjunto').style.display =  '';
		document.getElementById('resumen').style.display =  '';
	}
	//subofertero	
	else if(id ==29)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('adjunto').style.display =  '';
		document.getElementById('resumen').style.display =  '';
	}
	//eventos
	else if(id ==30)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}	
	//subeventos	
	else if(id ==31)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('mostrar_imagen2').style.display = '';
		document.getElementById('resumen').style.display =  '';
		document.getElementById('fecha_form').style.display = '';
	}	
	//Categoria vacantes	
	else if(id ==32)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//subcategorias vacantes	
	else if(id ==33)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('notas').style.display =  '';
		document.getElementById('resumen').style.display =  '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('mail_autor').style.display = '';
		
	}
	//Reseñas	
	else if(id ==34)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		//document.getElementById('resumen').style.display =  '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		//document.getElementById('destacado').style.display =  '';
		//document.getElementById('antetitulo').style.display =  '';
	}
	//Areas de trabajo	
	else if(id ==35)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//banners en imagen
	else if(id ==36)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('link').style.display = '';
	}
	//banners en flash
	else if(id ==37)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('link').style.display = '';
	}
	//planes creditos
	else if(id ==38)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('puntos').style.display = '';
		document.getElementById('precio_normal').style.display = '';
	}
	//planes tiempo
	else if(id ==39)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('puntos').style.display = '';
		document.getElementById('precio_normal').style.display = '';
	}
	//categoria tiendas
	else if(id ==40)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//tiendas
	else if(id ==41)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//minisite
	else if(id ==42)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		//document.getElementById('fecha_form').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('autor').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('horarioinicio').style.display =  '';
	document.getElementById('horariofin').style.display =  '';
	}
	//productos minisite
	else if(id ==43)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';

	}
	//si es tipo servicios
	else if(id == 44)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}
	//si es tipo subservicios
	else if(id == 45)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}
	//boletines
	else if(id == 46)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('descripcion').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}
	//Areas comunes
	else if(id == 47)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}
	//lista areas
	else if(id == 48)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}
	//Areas interna
	else if(id == 49)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen2').style.display = '';
		document.getElementById('imagen3').style.display = '';
		document.getElementById('imagen4').style.display = '';
		document.getElementById('descripcion').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('mostrar_imagen2').style.display = '';
		document.getElementById('mostrar_imagen3').style.display = '';
		document.getElementById('mostrar_imagen4').style.display = '';
	}
	//Encuestas
	else if(id == 50)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}
	//preguntas
	else if(id == 51)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}
	//preguntas
	else if(id == 52)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}
	//pelicula
	else if(id == 54)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('link').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
		document.getElementById('fecha_form').style.display = '';
	}
	//marca
	else if(id == 56)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('link').style.display = '';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}
	//categoria banners home
	else if(id == 57)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
	}//banner
	else if(id == 58)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('adjunto').style.display = '';
		document.getElementById('recom').style.display = 'none';
		
		//document.getElementById('imagen').style.display = '';
		//document.getElementById('imagen1_preview').style.display = '';
	}//categorias ofertas laborales
	else if(id == 59)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
	}//oferta laboral
	else if(id == 60)
	{
		campos('none');
		document.getElementById('titulo').style.display = '';
		document.getElementById('resumen').style.display = '';
		document.getElementById('telefono').style.display = '';
		document.getElementById('telefono2').style.display = '';
		document.getElementById('mail').style.display = '';
		document.getElementById('pie_imagen').style.display = 'none';
		document.getElementById('keywords').style.display = 'none';
		document.getElementById('notas').style.display = 'none';
		document.getElementById('imagen').style.display = '';
		document.getElementById('imagen1_preview').style.display = '';
	}
}
/*
* Funcion que sirve para seleccionar todos los checkbox 
*/
function marcar(obj)
{
  for (i=0; ele = obj.form.elements[i]; i++)
	if (ele.type=='checkbox')
	  ele.checked = obj.checked;
}
/*
*	funcion para obtener la informacion del 
*/
function cargarSelect(id,div)
{
	ruta_archivo	=	"externos/crearselect.php";
	document.getElementById('valor').value=id;
	div_n	=	(div + 1);
	//alert(div_n);
	//instancio el objeto ajax
	ajax=nuevoAjax();
	//paso los parametros por get al php
	ajax.open("GET", ruta_archivo+"?id="+id+"&div="+div_n);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1)
		{
			document.getElementById('opciones'+div_n).innerHTML="<img src='images/generics/ajax-loader_mini.gif'>";
		}
		else if (ajax.readyState==4)
		{
			if(div_n < 3)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('opciones'+div_n).innerHTML=resultado;
			}	
			
		}
	}
	 ajax.send(null);
}
function cargarSelect2(id,div)
{
	ruta_archivo	=	"externos/crearselect2.php";
	document.getElementById('valor').value=id;
	div_n	=	(div + 1);
	//alert(div_n);
	//instancio el objeto ajax
	ajax=nuevoAjax();
	//paso los parametros por get al php
	ajax.open("GET", ruta_archivo+"?id="+id+"&div="+div_n);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1)
		{
			document.getElementById('opciones'+div_n).innerHTML="<img src='images/generics/ajax-loader_mini.gif'>";
		}
		else if (ajax.readyState==4)
		{
			if(div_n < 3)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('opciones'+div_n).innerHTML=resultado;
			}	
			
		}
	}
	 ajax.send(null);
}
function ventanaPop(caja)
{
	var ancho = 1100;
	var alto  = 600;
	var posicion_x; 
	var posicion_y; 
	posicion_x=(screen.width/2)-(ancho/2); 
	posicion_y=(screen.height/2)-(alto/2);
	window.open('../repositorio/carga.php?caja='+caja,"Repositorio imágenes", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=yes,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
function ventanaPop2(caja)
{
	window.open('../files_repository/carga.php?caja='+caja, '_blank','width=1000,height=600');
}
function ventanaPop3()
{
	window.open('../repositorio2/carga.php', '_blank','scrollbars=yes,width=1000,height=450');
}
/*
* Funcion que realizara el funcionamiento de listar los jugadores para el aplicativo de resultados
* @param idusuario el cual es el id del usuario en session
* @param idproducto el cual sera el producto el cual se le relacionara
*/
function listaJugadores(valor,text)
{
	ruta_archivo	=	"externos/listajugadores.php";
	//instancio el objeto ajax
	ajax=nuevoAjax();
	if(valor != '')
	{
		//paso los parametros por get al php
		ajax.open("GET", ruta_archivo+"?valor="+valor+"&caja="+text);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1)
			{
				document.getElementById('text').style.display='';
				document.getElementById('text').innerHTML="<img src='images/generics/ajax-loader_mini.gif'>";
			}
			else if (ajax.readyState==4)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('text').style.display='';
				document.getElementById('text').innerHTML=resultado;
				
			}
		}
		 ajax.send(null);
	}
	else
	{
		document.getElementById('text').style.display='none';
	}
}
/*
* Funcion que realizara la relacion del producto con su categoria
* @param idproducto el cual es el id del producto
* @param idcategoria el cual sera el id de la categoria
*/
function asignaCategoria(idproducto,idcategoria,accion)
{
	//si es crear
	if(accion==1)
	{
			ruta_archivo	=	"externos/categorias.php";
			//instancio el objeto ajax
			ajax=nuevoAjax();
				//paso los parametros por get al php
				ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==1)
					{
						document.getElementById('mensaje').style.display='';
						document.getElementById('mensaje').innerHTML="<img src='images/generics/ajax-loader.gif'>";
					}
					else if (ajax.readyState==4)
					{
						//Aceptamos la respuesta del php
						var resultado = ajax.responseText;
						document.getElementById('mensaje').style.display='';
						document.getElementById('mensaje').innerHTML=resultado;
					}
				}
				 ajax.send(null);
	}
	//si es borrar
	else
	{
			if(confirm("Esta seguro que desea borrar esta relación??")==true)
			{
				ruta_archivo	=	"externos/categorias.php";
				//instancio el objeto ajax
				ajax=nuevoAjax();
					//paso los parametros por get al php
					ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1)
						{
							document.getElementById('mensaje').style.display='';
							document.getElementById('mensaje').innerHTML="<img src='images/generics/ajax-loader.gif'>";
						}
						else if (ajax.readyState==4)
						{
							//Aceptamos la respuesta del php
							var resultado = ajax.responseText;
							document.getElementById('mensaje').style.display='';
							document.getElementById('mensaje').innerHTML=resultado;
							document.getElementById('div'+idcategoria).style.display='none';
							
						}
					}
					 ajax.send(null);
			}
			else
			{
				return true;
			}
	}

}
/*Funcion para relacionar los usuarios a la categoría de archivo*/
function relacionarUsuarioArchivo(usuario,idcategoria,accion)
{
	ruta_archivo	=	"externos/usuarioCategoria.php";
	//instancio el objeto ajax
	ajax=nuevoAjax();
		//paso los parametros por get al php
		ajax.open("GET", ruta_archivo+"?usuario="+usuario+"&idcategoria="+idcategoria+"&accion="+accion);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1)
			{
				document.getElementById('evento'+usuario).innerHTML="<img src='images/generics/ajax-loader.gif'>";
			}
			else if (ajax.readyState==4)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('evento'+usuario).style.display='';
				document.getElementById('evento'+usuario).innerHTML=resultado;
			}
		}
		 ajax.send(null);
}

function ponerId(id,caja,texto)
{
	document.getElementById('text').style.display='none';
	document.getElementById('oculta').value=id;
	document.getElementById('caja').value=texto;
}
/*
*	asignar productos relacionados
*/
function productosRelacionados(idproducto,idcategoria,accion)
{
	//si es crear
	if(accion==1)
	{
		if(idcategoria == '')
		{
			alert("Recuerde que debe asignar una linea para el producto");
		}
		else
		{
			ruta_archivo	=	"externos/relacionados.php";
			//instancio el objeto ajax
			ajax=nuevoAjax();
				//paso los parametros por get al php
				ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==1)
					{
						document.getElementById('info').style.display='';
						document.getElementById('info').innerHTML="<img src='images/generics/ajax-loader.gif'>";
					}
					else if (ajax.readyState==4)
					{
						//Aceptamos la respuesta del php
						var resultado = ajax.responseText;
						document.getElementById('info').style.display='';
						document.getElementById('info').innerHTML=resultado;
					}
				}
				 ajax.send(null);
		}
	}
	//si es borrar
	else
	{
		if(idcategoria == '')
		{
			alert("Recuerde que debe asignar una linea para el producto");
		}
		else
		{
			if(confirm("Esta seguro que desea borrar esta relación??")==true)
			{
				ruta_archivo	=	"externos/categorias.php";
				//instancio el objeto ajax
				ajax=nuevoAjax();
					//paso los parametros por get al php
					ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1)
						{
							document.getElementById('info').style.display='';
							document.getElementById('info').innerHTML="<img src='images/generics/ajax-loader.gif'>";
						}
						else if (ajax.readyState==4)
						{
							//Aceptamos la respuesta del php
							var resultado = ajax.responseText;
							document.getElementById('info').style.display='';
							document.getElementById('info').innerHTML=resultado;
							document.getElementById('div'+idcategoria).style.display='none';
							
						}
					}
					 ajax.send(null);
			}
			else
			{
				return true;
			}
		}
	}

}

function alerta(titulo,mensaje,tipo,callback)
{
	swal({title: titulo,   text: mensaje,   type: tipo,   confirmButtonText: "Aceptar",   showLoaderOnConfirm: true, },function(){callback()});
}
/*
*	asignar productos relacionados
*/
function relacionContenidos(idproducto,idcategoria,accion,caja)
{
	//si es crear
	if(accion==1)
	{
		if(idcategoria == '')
		{
			alert("Recuerde que debe asignar una linea para el producto");
		}
		else
		{
			ruta_archivo	=	"externos/relacioncontenidos.php";
			//instancio el objeto ajax
			ajax=nuevoAjax();
				//paso los parametros por get al php
				ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion+"&caja="+caja);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==1)
					{
						document.getElementById('info'+caja).style.display='';
						document.getElementById('info'+caja).innerHTML="<img src='images/generics/ajax-loader.gif'>";
					}
					else if (ajax.readyState==4)
					{
						//Aceptamos la respuesta del php
						var resultado = ajax.responseText;
						document.getElementById('info'+caja).style.display='';
						document.getElementById('info'+caja).innerHTML=resultado;
					}
				}
				 ajax.send(null);
		}
	}
	//si es borrar
	else
	{
		if(idcategoria == '')
		{
			alert("Recuerde que debe asignar una linea para el producto");
		}
		else
		{
			if(confirm("Esta seguro que desea borrar esta relación??")==true)
			{
				ruta_archivo	=	"externos/categorias.php";
				//instancio el objeto ajax
				ajax=nuevoAjax();
					//paso los parametros por get al php
					ajax.open("GET", ruta_archivo+"?producto="+idproducto+"&categoria="+idcategoria+"&accion="+accion);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1)
						{
							document.getElementById('info').style.display='';
							document.getElementById('info').innerHTML="<img src='images/generics/ajax-loader.gif'>";
						}
						else if (ajax.readyState==4)
						{
							//Aceptamos la respuesta del php
							var resultado = ajax.responseText;
							document.getElementById('info').style.display='';
							document.getElementById('info').innerHTML=resultado;
							document.getElementById('div'+idcategoria).style.display='none';
							
						}
					}
					 ajax.send(null);
			}
			else
			{
				return true;
			}
		}
	}

}
/*listar contenidos en el suggest*/
function listacontenidos(valor,text,filtro)
{
	ruta_archivo	=	"externos/listarcontenidos.php";
	//instancio el objeto ajax
	ajax=nuevoAjax();
	if(valor != '')
	{
		//paso los parametros por get al php
		ajax.open("GET", ruta_archivo+"?valor="+valor+"&caja="+text+"&filtro="+filtro);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1)
			{
				document.getElementById('text'+text).style.display='';
				document.getElementById('text'+text).innerHTML="<img src='images/generics/ajax-loader_mini.gif'>";
			}
			else if (ajax.readyState==4)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('text'+text).style.display='';
				document.getElementById('text'+text).innerHTML=resultado;
				
			}
		}
		 ajax.send(null);
	}
	else
	{
		document.getElementById('text'+text).style.display='none';
	}
}
/*listar contenidos en el suggest de marcas*/
function listacontenidos2(valor,text)
{
	ruta_archivo	=	"externos/listarcontenidos2.php";
	//instancio el objeto ajax
	ajax=nuevoAjax();
	if(valor != '')
	{
		//paso los parametros por get al php
		ajax.open("GET", ruta_archivo+"?valor="+valor+"&caja="+text);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1)
			{
				document.getElementById('text'+text).style.display='';
				document.getElementById('text'+text).innerHTML="<img src='images/generics/ajax-loader_mini.gif'>";
			}
			else if (ajax.readyState==4)
			{
				//Aceptamos la respuesta del php
				var resultado = ajax.responseText;
				document.getElementById('text'+text).style.display='';
				document.getElementById('text'+text).innerHTML=resultado;
				
			}
		}
		 ajax.send(null);
	}
	else
	{
		document.getElementById('text'+text).style.display='none';
	}
}
function ponerCont(id,caja,texto)
{
	document.getElementById('text'+caja).style.display='none';
	document.getElementById('oculta'+caja).value=id;
	document.getElementById(caja).value=texto;
}

function sendForm()
{
	swal({
	  title: "Desea continuar?",
	  text: "La informaci&oacute;n ingresada en el formulario es correcta?",
	  type: "info",
	  html:true,
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Continuar",
	  cancelButtonText: "Cancelar",
	  closeOnConfirm: false
	},
	function()
	{
		$("#formPrincipal").submit();
	});

}