<?php

  //extract variables submitted to this page
  @extract($_GET);
  @extract($_POST);

  if(isset($action) && $action == "upload_file"){
    $local_file = $_FILES['local_file']['tmp_name'];
    if(!$local_file) $local_file = $HTTP_POST_FILES['local_file']['tmp_name'];
    $local_file = str_replace("\\\\", "\\", $local_file);

    if(file_exists($local_file)){
      $name = $_FILES['local_file']['name'];
      if(!$name) $name = $HTTP_POST_FILES['local_file']['name'];
//      $name = $HTTP_POST_FILES[local_file][name];
      copy($local_file, $files_path.$name);

      $uploaded = true;
    }
  }
?>
<html>
<head>
<title>Edit Table Cell</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

//actions performed after loading file on server
function on_load_local(){
<?php
  if($uploaded){

    switch($file_type){
      case 'image':
        echo 'window.top.document.form_name.preview_image.src=\''.$files_url.$name.'\'; window.top.window.is_local_file = false; window.top.return_image_parameters();';
        break;
      case 'link':
        echo 'window.top.document.form_name.href.value=\''.$files_url.$name.'\'; window.top.window.is_local_file = false; window.top.return_link_parameters();';
        break;
      default:
        break;
    }

  }
?>
}

</script>

</head>

<body bgcolor="buttonface" topmargin="0" leftmargin="0" rightmargin="0" onload="on_load_local();">

<form name="local_files_form" method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="action" value="upload_file">
<input type="hidden" name="files_path" value="<?php echo $files_path; ?>">
<input type="hidden" name="files_url" value="<?php echo $files_url; ?>">

<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr><td width="100%" height="100%" vAlign="center">
<input name="local_file" type="file" style="width:100%;height=30" onpropertychange="window.top.window.select_local_file();" onfocus="window.top.window.select_local_file();">
</td></tr>
</table>

</form>

</body>
</html>