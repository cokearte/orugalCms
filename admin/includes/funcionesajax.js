function objetoAjax(){

	var xmlhttp=false;
	
	try {
	
	
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	
	} catch (e) {
	
		try {
		
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		} catch (E) {
		
			xmlhttp = false;
		
		}
	
	
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	
	  	xmlhttp = new XMLHttpRequest();
	}
	
	return xmlhttp;
}

  
  
function cargaContenidoD(ano, mes, dia, destino, diad, dias)
{
	var anoss=document.getElementById(ano).options[document.getElementById(ano).selectedIndex].value;
	var valor=document.getElementById(mes).options[document.getElementById(mes).selectedIndex].value;
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById(dia);
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="D&iacute;a";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=objetoAjax();
		if(dias!=''){
			var tipo = "&tipo="+dias;
		}else{
			var tipo = "";
		}
		ajax.open("GET", "admin/includes/select_dependientes_fecha.php?anos="+anoss+"&seleccionado="+valor+"&pro=1&ids="+diad+tipo, true);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById(dia);
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;
			}
			if (ajax.readyState==4)
			{
				document.getElementById(destino).innerHTML=ajax.responseText;
			}
		}
		ajax.send(null);
	}
}