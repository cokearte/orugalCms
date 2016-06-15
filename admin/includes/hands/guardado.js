function calificar(calificacion,cont)
{
	ruta_archivo	=	"Herramientas/guardado.php";
	//instancio el objeto ajax
	ajax=nuevoAjax();
	//paso los parametros por get al php
	ajax.open("GET", ruta_archivo+"?cont="+cont+"&calificacion="+calificacion);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//Aceptamos la respuesta del php
			var resultado = ajax.responseText;
			document.getElementById('stars').innerHTML=resultado;
			
		}
	}
	 ajax.send(null);
}