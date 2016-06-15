<?php

  //extract variables submitted to this page
  @extract($_GET);

?><html>
<head>
<title>Create/Edit Image</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

  var is_local_file = false; //=true, if upload local file
  var is_init = false; //=true, if image load window initialization is performed

function return_image_parameters(){
  src = form_name.preview_image.src;

  if(src.search("images/space.gif") >= 0) return; //nothin chosen

  //upload a local file
  if(window.is_local_file){
    window.is_local_file = false;
    document.local_files.local_files_form.submit();

    return;
  }

  parameters = get_parameters();

  //add one more parameter - path to image
  parameters[parameters.length] = "src="+src;

  window.returnValue = parameters;

  window.close();
}

function on_temp_image_load(){
  if(window.is_local_file){ //local image

    local_window = window.local_files.window;
  
    document.all['width'].value = document.form_name.temp_image.width;
    document.all['height'].value = document.form_name.temp_image.height;
  
    //set image preview
    set_preview_image(local_window.local_files_form.local_file.value,
                      document.form_name.temp_image.width,
                      document.form_name.temp_image.height);

  }else{ //remote image
    document.all['width'].value = document.form_name.temp_image.width;
    document.all['height'].value = document.form_name.temp_image.height;
  
    //set image preview
    set_preview_image(document.form_name.temp_image.src,
                      document.form_name.temp_image.width,
                      document.form_name.temp_image.height);

  }

  if(window.is_init){
    document.all['width'].value = document.form_name.temp_image.width;
    document.all['height'].value = document.form_name.temp_image.height;

    set_preview_image(window.dialogArguments['src'],
                      document.form_name.temp_image.width,
                      document.form_name.temp_image.height);

    window.is_init = false;
  }
}

//makes image preview when dialog window opens
function on_image_load(){
  init_dialog();
  if(window.dialogArguments['src']){
    if(window.dialogArguments['width'] && window.dialogArguments['height']){
      document.all['width'].value = window.dialogArguments['width'];
      document.all['height'].value = window.dialogArguments['height'];
  
      set_preview_image(window.dialogArguments['src'],
                        window.dialogArguments['width'],
                        window.dialogArguments['height']);

    }else{ //neither width, nor height are defined - determine them
      window.is_init = true;
      document.form_name.temp_image.src = window.dialogArguments['src'];
    }
  }

}

//parses remote files select
function parse_select_remote_file(url, width, height){
  window.is_local_file = false;

  form_name.temp_image.src = url;

  //when image 'temp_image' is loaded, event 'onload' arose
  //setting sizes of the image
}

function select_local_file(){
  window.is_local_file = true;

  form_name.temp_image.src = window.local_files.window.local_files_form.local_file.value;

  //when image 'temp_image' is loaded, event 'onload' arose
  //setting sizes of the image
}

</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="buttonface" onload="on_image_load();">

<form name="form_name">

<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">

<tr>

<!-- window for remote files select  -->
<td width="100%" height="100%">

<iframe src="remote_files.php?initial_files_path=<?php echo $files_path; ?>&files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&file_type=image" name="remote_files" id="remote_files_id" border="0" scrolling="yes" style="width:100%; height:100%"></iframe>

</td>
<!-- !window for remote files select -->

<!-- window of preview and attributes of image -->
<td width="150" vAlign="top">

<!-- image for determining sizes of chosen image -->
<div style="position:absolute; top:0; left:0; visibility:hidden">
<img name="temp_image" src="images/space.gif" onload="on_temp_image_load();">
</div>
<!-- image for determining sizes of chosen image -->

<table border="1" cellspacing="0" cellpadding="0" height="100%">

<tr><td height="100%" colspan="2" align="center" vAlign="center">
<img name="preview_image" src="images/space.gif" border="0" width="1" height="1">
</td></tr>

<!-- image attributes -->
<tr><td colspan="2">

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Align:&nbsp;&nbsp;</td>
<td><input name="align" id="align_left" type="radio" value="left"></td>
<td><input name="align" id="align_center" type="radio" value="center"></td>
<td><input name="align" id="align_right" type="radio" value="right"></td>
</tr>
</table>

</td></tr>

<tr>
<td>Width:</td>
<td><input name="width" type="text" value="" size="4" maxlength="5"></td>
</tr>

<tr>
<td>Height:</td>
<td><input name="height" type="text" value="" size="4" maxlength="5"></td>
</tr>

<tr>
<td>Border:</td>
<td><input name="border" type="text" value="" size="4" maxlength="4"></td>
</tr>

<tr>
<td>Vspace:</td>
<td><input name="vspace" type="text" value="" size="4" maxlength="4"></td>
</tr>

<tr>
<td>Hspace:</td>
<td><input name="hspace" type="text" value="" size="4" maxlength="4"></td>
</tr>

<tr>
<td>Alt:</td>
<td><input name="alt" type="text" value="" size="4" maxlength="255"></td>
</tr>
<!-- image attributes -->

</table>

</td>
<!-- !window of preview and attributes of image -->

</tr>

<!-- window for local files select -->
<tr><td colspan="2" width="100%" height="35">

<iframe src="local_files.php?files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&file_type=image" name="local_files" id="local_files_id" border="0" scrolling="no" style="width:100%; height:100%;"></iframe>

</td></tr>
<!-- !window for local files select -->

<tr><td colspan="2" height="1">
<center>
<input type="Button" value="Ok" onclick="return_image_parameters();">
<input type="Button" value="Cancel" onclick="window.close();">
</center>
</td></tr>

</table>

</form>

</body>
</html>
