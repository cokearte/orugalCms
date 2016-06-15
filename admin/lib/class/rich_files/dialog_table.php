<?php

  //extract variables submitted to this page
  @extract($_GET);

?><html>
<head>
<title>Create/Edit Table</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

  var is_init = false; //=true, if window is initialized

<?php
  if($files_path) echo "dialog_files_path = '$files_path';\n";
  if($files_url) echo "dialog_files_url = '$files_url';\n";
?>

function on_temp_image_load(){
  if(window.is_init){

    set_preview_table_image(document.form_name.background_image,
                            document.form_name.temp_image.src,
                            document.form_name.temp_image.width,
                            document.form_name.temp_image.height);

    window.is_init = false;
  }
}

function init_table_dialog(){
  editing_mode = init_dialog();

  if(!editing_mode){//initializing
    document.form_name.rows.value = 2;
    document.form_name.columns.value = 2;
    document.form_name.border.value = 1;
  }

}

</script>

</head>

<body bgcolor="buttonface" onload="init_table_dialog();">

<form name="form_name">

<!-- image to determine sizes of chosen image -->
<div style="position:absolute; top:0; left:0; visibility:hidden">
<img name="temp_image" src="images/space.gif" onload="on_temp_image_load();">
</div>
<!-- image to determine sizes of chosen image -->

<table border="0" cellspacing="10" cellpadding="2" height="100%" align="center"><tr><td>

<table border="0" cellspacing="0" cellpadding="0"><tr><td valign="center">

<!-- Rows, Columns and Sizes -->
<b>Rows, Columns and Sizes:</b>
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Rows:</td>
<td><input name="rows" type="text" value="" size="4" maxlength="3"></td>
</tr>
<tr>
<td>Columns:</td>
<td><input name="columns" type="text" value="" size="4" maxlength="3"></td>
</tr>
</table>

</td>

<td>&nbsp;&nbsp;</td>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Width:</td>
<td><input name="width" type="text" value="" size="4" maxlength="5"></td>
</tr>
<tr>
<td>Height:</td>
<td><input name="height" type="text" value="" size="4" maxlength="5"></td>
</tr>
</table>

</td>

</tr>
</table>
<!-- Rows, Columns and Sizes -->

<br>

<!-- Background -->
<b>Background:</b>
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Color:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table id="bgColor_table" bgColor="#ffffff" height="20" width="20" onClick="set_color();"><tr><td></td></tr></table></td>
<td><input type="checkbox" name="bgColor" onClick="if(checked) set_color();"></td>
</tr>
</table>

</td>
</tr>
</table>

</td>

<td>&nbsp;&nbsp;</td>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Image:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table border="0" cellspacing="0" cellpadding="0"><tr><td width="100" height="100" align="center" vAlign="center"><img name="background_image" src="images/space.gif" height="100" width="100" onClick="set_image(); return false;"></td></tr></table></td>
<td><input type="checkbox" name="background" onClick="if(checked) set_image();"></td>
</tr>
</table>

</td>
</tr>
</table>

</td>

</tr>
</table>
<!-- Background -->

<br>

<!-- Padding and Spacing -->
<b>Cell Padding, Cell Spacing:</b>
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Cell Padding:</td>
<td><input name="cellPadding" type="text" value="" size="4" maxlength="3"></td>
</tr>
<tr>
<td>Cell Spacing:</td>
<td><input name="cellSpacing" type="text" value="" size="4" maxlength="3"></td>
</tr>
</table>

</td>

</tr>
</table>
<!-- Padding and Spacing -->

<br>

<!-- Border -->
<b>Border:</b>
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Width:</td>
<td><input name="border" type="text" value="" size="4" maxlength="3"></td>
</tr>
<tr>
<td>Color:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table id="borderColor_table" bgColor="#ffffff" height="20" width="20" onClick="set_color();"><tr><td></td></tr></table></td>
<td><input type="checkbox" name="borderColor" onClick="if(checked) set_color();"></td>
</tr>
</table>

</td>
</tr>
</table>

</td>

<td>&nbsp;&nbsp;</td>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Colorlight:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table id="borderColorLight_table" bgColor="#ffffff" height="20" width="20" onClick="set_color();"><tr><td></td></tr></table></td>
<td><input type="checkbox" name="borderColorLight" onClick="if(checked) set_color();"></td>
</tr>
</table>

</td>
</tr>

<tr>
<td>Colordark:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table id="borderColorDark_table" bgColor="#ffffff" height="20" width="20" onClick="set_color();"><tr><td></td></tr></table></td>
<td><input type="checkbox" name="borderColorDark" onClick="if(checked) set_color();"></td>
</tr>
</table>

</td>
</tr>
</table>

</td>

</tr>
</table>
<!-- Border -->

<br>
<center>
<input type="Button" value="Ok" onclick="window.returnValue=get_parameters(); window.close();">
<input type="Button" value="Cancel" onclick="window.close();">
</center>

</td></tr></table>

</td></tr></table>

</form>

</body>
</html>