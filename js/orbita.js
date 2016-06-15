var imagenActual = 0;
var imagenActual2 = 0;
var ant;
var mensaje 	 = ["Los pasajeros son ustedes","Dentro de este universo","Bienvenidos a este espacio","Vamos a girar juntos","Esos giros que completan objetivos"];
$(document).ready(function(){
	main();

	//anclas
	 $('a[href*=#]').click(function() {

     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
         && location.hostname == this.hostname) {

             var $target = $(this.hash);

             $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

             if ($target.length) {

                 var targetOffset = $target.offset().top;

                 $('html,body').animate({scrollTop: targetOffset}, 1000);

                 return false;

            }

       }

   });
	/*$(window).scroll(function(){
	    // servicios1(this)
	    seleccionado(this);
	});*/
	eventInfo = ["y nosotros los anfitriones, giremos 360° en nuestra Orbita Empresarial","de posibilidades, Órbita empresarial los invita a dar un giro por la comunicación inteligente","donde pedaleamos con objetivos y viajamos con maletas llenas de ideas","y a recordarlos toda la vida con una sonrisa de satisfacción","son los que nosotros estamos dispuestos a ofrecer"];
	$(function () {
        $(".typed").typed({
        strings: eventInfo,
        typeSpeed: 50,
        backDelay: 2000,
        loop: true,
        preStringTyped:function(){
        	cambioImagen();
        }
        });
    });

	//$('body').tubular('5rKpLUzcpHs','home'); 
	//event to direction buttons in equipo section
	$(".directionButtons").click(function(){
		direction(this);
	});

	//cambioCaso("n");
	cambioImagen2();
	bgadj();
	window.onresize = function() {
        bgadj();
    }

    $('a.smoothScroll').smoothScroll({
	offset: -80,
	scrollTarget: $(this).val()
	});

	$('.puntosControl').waypoint(
		function(direction) {
		if (direction ==='down') {
		var wayID = $(this).attr('id');
		} else {
		var previous = $(this).prev();
		var wayID = $(previous).attr('id');
		}
		$('.current').removeClass('current');
		$('#main_nav a[href=#'+wayID+']').addClass('current');
		}, { offset: '40%' });

		});

var contador = 1;
var ancho = $(window).width();
var alto = $(window).height();
var anchoD = $(document).width();

function cambioImagen2()
{
	$("#asigiramos").removeClass("bg0");
	$("#asigiramos").removeClass("bg1");
	$("#asigiramos").removeClass("bg2");
	$("#asigiramos").removeClass("bg3");
	$("#asigiramos").removeClass("bg4");
	//$("#mainText").html(mensaje[imagenActual2]);
	$("#asigiramos").addClass("bg"+imagenActual2);
	if(imagenActual2 == 4)
	{
		imagenActual2 = 0;
		ant = imagenActual2;
	}
	else
	{
		ant = imagenActual2;
		imagenActual2++;	
	}
	setTimeout(function(){
		cambioImagen2();
	},10000)
}


function cambioImagen()
{
	/*$("#home").removeClass("bg0");
	$("#home").removeClass("bg1");
	$("#home").removeClass("bg2");
	$("#home").removeClass("bg3");
	$("#home").removeClass("bg4");*/
	$("#mainText").html(mensaje[imagenActual]);
	/*$("#home").addClass("bg"+imagenActual);*/
	if(imagenActual == 4)
	{
		imagenActual = 0;
		ant = imagenActual;
	}
	else
	{
		ant = imagenActual;
		imagenActual++;	
	}
	
}
function cambioCaso(dir)
{
	if(dir == "n")
	{
		var el 		=	$(".owl-item.center").next();
	}	
	else
	{
		var el 		=	$(".owl-item.center").prev();
	}
	var idElemento 		=	$(el).find("div").data("id");
	//alert(idElemento);
	//find(".fotoMniCaso").data("id");
	getInfoCaso(idElemento);
}
function main ()
{

	var mitadPantalla	=	(parseInt(ancho) / parseInt(2));
	$('#home').parallax("50%", 0.20);
	$('#asigiramos').parallax("50%", 0.20);
	$('#pie').parallax("150%", 0.00);
	
	//$(".fotoMniCaso").css("width",mitadPantalla+"px");
	setTimeout(function(){
		$('.owl-carousel').owlCarousel({
				    loop:true,
				    margin:10,
				    autoplay:true,
				    autoplayTimeout:3000,
				    autoplayHoverPause:true,
				    onChanged:function(){
				    	cambioCaso('n');
				    },
				    responsive:{
				        0:{
				            items:3
				        },
				        600:{
				            items:3
				        },
				        1000:{
				            items:3
				        }
				    }
				});
		var tamanoTextoCaso = $("#textoCaso").width();
		//calculando la posicion de los botones de navegacion del carousel de los casos de éxito
		//el calculo es restarle al tamaño total de la pantalla lo que mida el text contenedor de caso de éxito.
		var calculo     =	(parseInt(ancho) - parseInt(tamanoTextoCaso));
		//ahora a este resultado lo divido en 2 yesaesladistancia de cada boton.
		var distancia	=	((parseInt(calculo) / parseInt(2))  -  parseInt(100));
		//pongo la distancia
		$(".owl-prev").css("left",distancia+"px");
		$(".owl-next").css("right",distancia+"px");

		//proceso la información de los casos de uso
		var idElemento 		=	$(".owl-item.center div").data("id");
		//find(".fotoMniCaso").data("id");
		getInfoCaso(idElemento);

		$(".owl-next").click(function(){cambioCaso("n")});
		$(".owl-prev").click(function(){cambioCaso("p")});

	},1000);

	$('.menu_bar').click(function(){
		// $('nav').toggle(); Forma Sencilla de aparecer y desaparecer
		
		if (contador == 1){
			$('nav').animate({
				right: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				right: '-100%'
			});
		};
	});
	// Mostramos y ocultamos submenus
	$('.submenu').click(function(){
		$(this).children('.children').slideToggle();
	});

	//todos los paneles deben tener la misma altura del navegador donde cargue la página
	//alert(alto);
	$(".paneles").css("height",alto+"px");

	
	$(".verMasCuentos").click(function(){
		var rel  = $(this).attr("rel");
		activaCuento(rel,1);	
	});

	var homeSize		=	$("#home").height();
	var distancia 		=	(homeSize - 200);
	$("#home  h2").css("margin",distancia+"px 0 0 0")
	
	
};

function servicios1(e)
{
    window_y 		= $(e).scrollTop(); // VALOR QUE SE HA MOVIDO DEL SCROLL
    var position	=	$("#servicios").position();
    scroll_critical =   (parseInt(position.top) - 400); // VALOR DE TU DIV
    //alert(scroll_critical);
    //alert(scroll_critical);
   //console.log(scroll_critical+" "+window_y);
    if (window_y > scroll_critical) { // SI EL SCROLL HA SUPERADO EL ALTO DE TU DIV
    	//console.log(scroll_critical+" "+window_y);
       $(".srv1").fadeIn("fast",function(){$(".srv2").fadeIn("fast",function(){$(".srv3").fadeIn("fast",function(){$(".srv4").fadeIn("fast")})})})
    } else {
       $(".servicios1").fadeOut();
       $(".servicios2").fadeOut();
    }
}

function selMenu(e,div)
{
	$(".elMenu").removeClass("menuSel");
    $(div).addClass("menuSel");
}/*
function seleccionado(e)
{
    window_y 		= 	$(e).scrollTop(); // VALOR QUE SE HA MOVIDO DEL SCROLL
    var position	=	$("#nuestroCuento").position();
    scroll_critical =   (parseInt(position.top) - 400); // VALOR DE TU DIV
    //mapeo todos los elementos para hacer scroll
    var elServ 	  = $("#nuestroCuento").position();
    var elQuienes = $("#asigiramos").position();
    var elCasos	  = $("#losquecreen").position();
    var elEquipo  = $("#laorbita").position();
    var noticias  = $("#enterate").position();
    var elPie	  = $("#pie").position();



    if(window_y >= elServ.top)//nuestro cuento
    {
    	//alert("Es mayor "+elServ.top+" "+Math.round(elQuienes.top))
    	$(".elMenu").removeClass("menuSel");
    	$("#menuServ").addClass("menuSel");
    }
    if (window_y >= elQuienes.top) { // SI EL SCROLL HA SUPERADO EL ALTO DE TU DIV
    	//alert("here")
    	$(".elMenu").removeClass("menuSel");
    	$("#menuQuienes").addClass("menuSel");
    }
    if(window_y >= elCasos.top)
    {
    	$(".elMenu").removeClass("menuSel");
    	$("#menuCasos").addClass("menuSel");
    }
     if(window_y >= elEquipo.top)
    {
    	$(".elMenu").removeClass("menuSel");
    	$("#menuEquipo").addClass("menuSel");
    }
    if(window_y >= noticias.top)
    {
    	$(".elMenu").removeClass("menuSel");
    	$("#menuNoticias").addClass("menuSel");
    }

    /*if(window_y <= elServ.top)
    {
    	$(".elMenu").removeClass("menuSel");
    }

    if(window_y >= elPie.top)
    {
    	$(".elMenu").removeClass("menuSel");
    }*/
   /* else
    {
    	$(".elMenu").removeClass("menuSel");
    }
}*/

function anclar(e)
{
	e.preventDefault();
	var target = jQuery(this).attr('href');
	target = target.length && target || $('[name=' + this.hash.slice(1) +']');
	alert(target);
	var new_position = jQuery('#'+target).offset();

	 $('html, body').animate({
        scrollTop:new_position.top
    },1000);
	//window.scrollTo(new_position.left,new_position.top);
	return false;
}
function direction(e)
{
	var elementoVisible	=	$(".centroequipo.visible");
	var idVisible		=	elementoVisible.attr("id");
	var cantidadElementos	= $(".centroequipo").length;
	//alert(idVisible);
	var elementBtn	=	$(e);
	/*var ventanaEquipoActual	=	$(".centroequipo");*/
	if(elementBtn.hasClass("next"))
	{
		if(idVisible == cantidadElementos)
		{
			idVisible=0;
		}
		idVisible++;
		$(".centroequipo").removeClass("visible");
		$(".centroequipo").addClass("oculta");
		$("#"+idVisible).addClass("visible");
		$("#"+idVisible).removeClass("oculta");
		

	}
	else
	{
		if(idVisible == 1)
		{
			idVisible= parseInt(cantidadElementos) + parseInt(1);
		}
		idVisible--;
		$(".centroequipo").removeClass("visible");
		$(".centroequipo").addClass("oculta");
		$("#"+idVisible).addClass("visible");
		$("#"+idVisible).removeClass("oculta");
		
	}
}
function getInfoCaso(id)
{
	//alert(id);
	$.ajax({
        type: "POST",
        url: "externos/query.php",
        data: "accion=1&id="+id,
        dataType:"json",
        beforeSend: function(objeto){
        	
        },
        success: function(respuesta)
        {
        	$("#tituloCaso").html(respuesta.titulo);
			$("#textoCaso").html(respuesta.resumen);
      	},
      	error: function (var1,var2,var3){
      		
      	}
	});
}

function activaCuento(id,a)
{
	//capturo el texto
	var texto 	=	$("#textoOculto"+id).html();
	var img 	=	$("#img"+id).attr("src");
	var tit 	=	$("#titulo"+id).html();
	if(a == 1)
	{
		$("#panelTrans").fadeIn();
		$("body").css("overflow","hidden");
		$("#txtPop").html("<h2>"+tit+"</h2><br>"+texto);
		$("#imgPop").html("<img src='"+img+"'>");
	}
	else
	{
		$("#panelTrans").fadeOut();
		$("body").css("overflow","auto");
		$("#txtPop").html("");
		$("#imgPop").html("");
	}
}

function bgadj()
{
        
     $("#video").css("width",anchoD);
     $("#video").css("height","auto");    
    /*var videoActualWidth = video.getBoundingClientRect().width;
    var videoActualHeight = video.getBoundingClientRect().height;
          
    var ratio =  videoActualWidth / videoActualHeight;         
     
    if ((window.innerWidth / window.innerHeight) < ratio){
      
        video.setAttribute("style", "width: auto");
        video.setAttribute("style", "height: 100%");
          
        
        if (videoActualWidth > window.innerWidth){
          
            var ajuste = (window.innerWidth - videoActualWidth)/2;                
            
            video.setAttribute("style", "left:"+ajuste+"px");          
        }
      
    }
    else{ 
      
        video.setAttribute("style", "width: 100%");
        video.setAttribute("style", "height: auto");
        video.setAttribute("style", "left: 0");

    }*/
      
}

function buscar()
{
	//primero realizo la busqueda con ajax
	//resultadoBuscar
	var cadena = $("#cajaBuscador").val();
	if(cadena != "")
	{
		$.ajax({
	        type: "POST",
	        url: dominio+"externos/query.php",
	        data: "accion=2&cadena="+cadena,
	        beforeSend: function(objeto)
	        {
	        	
	        },	
	        success: function(respuesta)
	        {
	        	$("#resultadoBuscar").show();
	        	$("#resultadoBuscar").html(respuesta);
	      	},
	      	error: function (var1,var2,var3){
	      		
	      	}
		});
	}
	else
	{
		$("#resultadoBuscar").hide();
	}
	
}
