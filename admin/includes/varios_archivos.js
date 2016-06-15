var numero = 0;

// Funciones comunes
c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}

addField = function () {

   container = d('files');
   
  
   span = c('SPAN');
   span.className = 'file';
   span.id = 'file' + (++numero);

   field = c('INPUT');   
   field.name = 'archivos[]';
   field.type = 'file';
   
   
   a = c('BUTTON');
   a.name = span.id;
   a.onclick = removeField;
   a.innerHTML = 'Quitar';

   span.appendChild(field);
   span.appendChild(a);
   container.appendChild(span);
   
}
removeField = function (evt) {
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
}
