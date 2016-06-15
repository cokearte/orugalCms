angular.module('Hippie',[])
	.controller('homCtrl', function($scope,$http,$q){




		$scope.menus = [
			{"Titulo":"Ensalada de camarones","plato":"Ensalada de camarones y mango viche (cristales de gazpacho, leche de tigre de albahaca y coco)","Precio":"$21.000"},
			{"Titulo":"Queso de cabra","plato":"Queso de cabra al horno con miel orgánica, frutos secos, tatsoi y pan  VGT)","Precio":"$29.000"},
			{"Titulo":"Salteado de pulpo","plato":"Salteado de pulpo y vegetales con papa criolla en aroma de hinojo (espárragos, alcachofas confitadas, tomates perla)","Precio":"$28.000"},
			{"Titulo":"Quinua","plato":"Quinua con hongos frescos y secos  VG","Precio":"$20.000"},
			{"Titulo":"Ahuyama al horno","plato":"Ahuyama al horno con queso Paipa D.O., frutos secos y rúgula  VGT - VG","Precio":"$19.000"},
			{"Titulo":"Lomo de res","plato":"Lomo de res curado en tomillo, pimienta e hinojo, crema de queso de cabra y pan","Precio":"$19.500"},
			{"Titulo":"Crema de zanahoria","plato":"Crema de zanahoria y ahuyama con cúrcuma, brotes de remolacha y chia potencializada ","Precio":"$16.000"},
			{"Titulo":"Montaditos en pan","plato":"Montaditos en pan de centeno de cangrejo en mayonesa de trufa, espárrago y mejorana","Precio":"$18.800"},
			{"Titulo":"Pesca fresca del día","plato":"Pesca fresca del día, pure de arvejas, mermelada de tomate y germinados","Precio":"$20.000"},
			{"Titulo":"Crema de tomates.","plato":"Crema de tomates con maíz y aguacate  VG","Precio":"$16.000"}
		];
		$scope.servi = [
		{"estilo":"background: url(img/galeria/RENA1859.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/RENA1823.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/RENA1766.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5517.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5497.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5495.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5494.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_4820.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5491.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5488.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5220.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		{"estilo":"background: url(img/galeria/IMG_5415.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"},
		];
	$scope.ImagenGrande=function()
	{
		alert("Proximamente una galeria bien chula y coqueta");
	}

	$scope.initHippie=function(){
		//para las reservas
		$('#dataTime').datetimepicker({
                format: 'YYYY-MM-DD'
         });
		$('#hora').datetimepicker({
                format: 'HH:mm'
         });

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

		 $('[data-toggle="tooltip"]').tooltip(); 

	$('.headerImg').parallax("50%", 0.20);
	$('.platein').parallax("50%", 0.20);
	//	$('.Reserva').parallax("50%", 0.1);
		//alert("asdasdasd")
		//oculta todos los paneles
		$.each($(".contMenu"),function(){
			var rel = $(this).attr("rel");
			$(".panel"+rel).hide();
			$(".panel"+rel).first().show();

			$(".pestanas"+rel).removeClass("active")
			$(".pestanas"+rel).first().addClass("active")
		})
	}
	$scope.cambiaPanel = function(id,cont)
	{
		$(".panel"+cont).hide();
		$("#pest"+id).show();

		$(".pestanas"+cont).removeClass("active")
		$("#pestana"+id).addClass("active")
	}
});

$( document ).ready(function() {
    var ancho = $("#ancho").width();
	$(".tmGry").css("height",ancho);
});