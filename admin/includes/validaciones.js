function nuevoAjax(){
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

function valida_registro(obj)
{
	ok  = false;
	var re=/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	
	if(obj.nombre != null && obj.nombre.value == ""){
		alert("Ingresa tu nombre.");
		obj.nombre.focus();
	}else if(obj.apellido != null && obj.apellido.value == ""){
		alert("Ingresa el apellido.");
		obj.apellido.focus();
	}else if((obj.ano1 != null && obj.ano1.value == "") || (obj.mes1 != null && obj.mes1.value=="") || (obj.dia1 != null && obj.dia1.value=="")){
		alert("Ingresa la fecha de cumpleaños.");
		obj.ano1.focus();
	}else if(obj.cargo != null && obj.cargo.value == ""){
		alert("Ingresa el cargo.");
		obj.cargo.focus();
	}else if(obj.calle != null && obj.calle.value == ""){
		alert("Ingresa la calle.");
		obj.calle.focus();
	}else if(obj.menu1!=null && obj.menu1.value==""){
		alert("Ingresa el estado.");
		obj.menu1.focus();
	}else if(obj.menu2 != null && obj.menu2.value == ""){
		alert("Ingresa la delegacion.");
		obj.menu2.focus();
	}else if(obj.menu3 != null && obj.menu3.value == ""){
		alert("Ingresa la colonia.");
		obj.menu3.focus();
	}else if(obj.cp != null && obj.cp.value == ""){
		alert("Ingresa el codigo postal.");
		obj.cp.focus();
	}else if(obj.instrumentos != null && obj.instrumentos.value==""){
		alert("Debe colocar que instrumentos toca");
		obj.instrumentos.focus();
	}else if(document.getElementById("telefono") != null && document.getElementById("telefono").value == ""){
		alert("Ingresa el telefono");
		document.getElementById("telefono").focus();
	}else if(document.getElementById("telefono").value.length < 8){
		alert("Telefono debe tener 8 digitos");
		document.getElementById("telefono").focus();
	}else if(obj.email != null && obj.email.value == ""){
		alert("Ingresa tu e-mail");
		obj.email.focus();
	}else if(!re.test(obj.email.value)){
		alert("Email invalido!!!");
		obj.email.focus();
	}else{
		ok = true;}
	return ok;
}
function esInteger(e) {
var charCode
if (navigator.appName == "Netscape") // Veo si es Netscape o Explorer
charCode = e.which // leo la tecla que ingreso
else
charCode = e.keyCode // leo la tecla que ingreso
status = charCode 
if (charCode > 31 && (charCode < 48 || charCode > 57)) { // Chequeamos que sea un numero comparandolo con los valores ASCII
alert("Sólo Números!!")
return false
}
return true
}