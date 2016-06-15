function show_hide(id) {
	document.getElementById(id).style.backgroundColor = "white";
 disp = document.getElementById(id).style.display;
 
  if(disp == "block")
    document.getElementById(id).style.display = "none";
  else
    document.getElementById(id).style.display = "block";
 }