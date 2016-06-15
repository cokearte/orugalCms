<html>
<head>
<title>Edit Table Cell</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

</script>

</head>

<body bgcolor="buttonface" onload="init_dialog();">

<form name="form_name">

<table border="0" cellspacing="10" cellpadding="2" height="100%" align="center"><tr><td>

<!-- Sizes -->
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td valign="center">

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Width:</td>
<td><input name="width" type="text" value="" size="4" maxlength="4"></td>
</tr>
</table>

</td>

<td>&nbsp;&nbsp;</td>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Height:</td>
<td><input name="height" type="text" value="" size="4" maxlength="4"></td>
</tr>
</table>

</td>

</tr>
</table>
<!-- Sizes -->

<br>

<!-- vAlign and Color -->
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>vAlign:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td><input name="vAlign" id="vAlign_top" type="radio" value="top"></td></tr>
<tr><td><input name="vAlign" id="vAlign_center" type="radio" value="center"></td></tr>
<tr><td><input name="vAlign" id="vAlign_bottom" type="radio" value="bottom"></td></tr>
</table>

</td>
</tr>
</table>

</td>

<td>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;</td>

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

</tr>
</table>
<!-- vAlign and Color -->

<br>
<center>
<input type="Button" value="Ok" onclick="window.returnValue=get_parameters(); window.close();">
<input type="Button" value="Cancel" onclick="window.close();">
</center>

</td></tr></table>

</form>

</body>
</html>