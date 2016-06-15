<?php

  //extract variables submitted to this page
  @extract($_GET);

?><html>
<head>
<title>Create/Edit Link</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

  var is_local_file = false; //=true, if local file is uploaded

function return_link_parameters(){

  if(window.is_local_file){
    window.is_local_file = false;
    document.local_files.local_files_form.submit();

    return;
  }

  parameters = get_parameters();

  window.returnValue = parameters;

  window.close();
}

//parses remote file select
function parse_select_remote_file(url, width, height){

  window.is_local_file = false;

  document.form_name.href.value = url;

}

//parses local file select
function select_local_file(){
  window.is_local_file = true;
}

</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="buttonface" onload="init_dialog();">

<form name="form_name" onsubmit="return_link_parameters(); return false;">

<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">

<tr>

<!-- window of remote files select -->
<td colspan="2" width="100%" height="100%">

<iframe src="remote_files.php?initial_files_path=<?php echo $files_path; ?>&files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&file_type=link" name="remote_files" id="remote_files_id" border="0" scrolling="yes" style="width:100%; height:100%"></iframe>

</td>
<!-- !window of remote files select -->

</tr>

<!-- window of local files select -->
<tr><td colspan="2" width="100%" height="35">

<iframe src="local_files.php?files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&file_type=link" name="local_files" id="local_files_id" border="0" scrolling="no" style="width:100%; height:100%;"></iframe>

</td></tr>
<!-- !window of local files select -->

<!-- reference attribute -->
<tr>
<td width="1">Target:</td>
<td>
<select name="target">
  <option value=""></option>
  <option value="_self">current window</option>
  <option value="_blank">new window</option>
</select>
</td>
</tr>

<tr>
<td width="1">Link:</td>
<td width="100%"><input name="href" type="text" value="" style="width:100%;"></td>
</tr>
<!-- !reference attribute -->

<tr><td colspan="2" height="1">
<center>
<input type="Button" value="Ok" onclick="return_link_parameters();">
<input type="Button" value="Cancel" onclick="window.close();">
</center>
</td></tr>

</table>

</form>

</body>
</html>
