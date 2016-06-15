<html>
<head>
<title>ColorPicker</title>

<script language="JScript.Encode" src="rich.js"></script>

<script language="JavaScript">
function select_color(){
  element = window.event.srcElement;

  if(element && element.tagName=='IMG' && element.parentElement){
    td = get_previous_object(element.parentNode,'TD');
    form_name.color.value = td.bgColor;

    color_td.bgColor = td.bgColor;
  }

}
</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="buttonface">
<table border="0" cellspacing="0" cellpadding="0" height="100%" align="center">
<tr><td>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td valign="center">

<table onclick="select_color();" border="1" cellspacing="0" cellpadding="0">

<script language="JavaScript">
var points = new Array("00","33","66","99","CC","FF");
var points_num = points.length;
var text = "";

  for(r=0;r<points_num;r++){
    text+="<TR>"
    for(g=points_num-1;g>=0;g--)
      for(b=points_num-1;b>=0;b--){
        color = points[r]+points[g]+points[b] 
        text += '<td bgColor="#'+color+'">'
             +  '<img src="images/space.gif" width="10" height="10"'
             +  ' alt="#'+color+'" style="cursor:hand"></td>';
      }
      text+="</tr>";
  }
  document.write(text);
</script>

</table>

<br>

<form name="form_name" onsubmit="window.returnValue = form_name.color.value; window.close(); return false;">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td id="color_td" bgcolor="#ffffff"><img src="images/space.gif" width="40" height="20"></td>
<td>&nbsp</td>
<td>
<input type="Text" name="color" size="8" maxsize="8" value="#ffffff">
<input type="Button" value="Ok" onclick="window.returnValue = form_name.color.value; window.close();">
<input type="Button" value="Cancel" onclick="window.close();">
</td>
</tr></table>
</form>

</td></tr></table>

</td></tr></table>
</body>
</html>