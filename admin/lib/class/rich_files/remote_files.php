<?php

  //extract variables submitted to this page
  @extract($_GET);
  @extract($_POST);

  //deletes files and directories
  if(isset($action) && $action == "delete" && $file){
    if(is_file($files_path.$file)){ //file
      @unlink($files_path.$file);
    }else{ //directory
      @rmdir($files_path.$file);
    }
  }
?>
<html>
<head>
<title>Edit Table Cell</title>

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  rich_path = ''; //path to directory with editor files, here - current directory

//if window of local files exist, set path and url
//for current directory of remote files
if(window.top.local_files.window.local_files_form){
  window.top.local_files.window.local_files_form.files_path.value = '<?php echo $files_path; ?>';
  window.top.local_files.window.local_files_form.files_url.value = '<?php echo $files_url; ?>';
}

//calls parser of remote files select
function select_remote_file(url, width, height){
  window.top.window.parse_select_remote_file(url, width, height);
}

</script>

</head>

<body bgcolor="buttonface" topmargin="0" leftmargin="0" rightmargin="0">

<form name="remote_files_form">

<!-- list of remote files -->
<table border="1" cellspacing="0" cellpadding="0" width="100%" style="font:14;">

<tr><td colspan="2"><b>File name:</b></td></tr>

<?php
  //parameters of parent directory
  $temp_str = substr($files_path,0,strrpos($files_path,"/"));
  $upper_dir_name = substr($temp_str,0,strrpos($temp_str,"/")+1);
  $temp_str = substr($files_url,0,strrpos($files_url,"/"));
  $upper_dir_url = substr($temp_str,0,strrpos($temp_str,"/")+1);

  //show list of files
  $handle=@opendir($files_path);
  if($handle){
    while($file = readdir($handle)){
      if($file != "."){

        if(is_file($files_path.$file)){ //files

          switch($file_type){
  
            case "image":
              $size = @getimagesize($files_path.$file);
              if($size[2]){ //image
                echo "<tr><td width=\"100%\">\n&nbsp;";
                echo '<a href="#" onClick="select_remote_file(\''.$files_url.$file.'\','.$size[0].','.$size[1].'); return false;">'.$file.'</a>';
                echo "</td>";
                echo '<td width="1"><a href="javascript: if (window.confirm(\'Delete file/dir?\')) window.location = \'?initial_files_path='.$initial_files_path.'&files_path='.$files_path.'&files_url='.$files_url.'&file_type='.$file_type.'&action=delete&file='.$file.'\';">x</a></td>';
                echo "</tr>\n";
              }
              break;

            default:
              echo "<tr><td>\n&nbsp;";
              echo '<a href="#" onClick="select_remote_file(\''.$files_url.$file.'\'); return false;">'.$file.'</a>';
              echo "</td>";
              echo '<td width="1"><a href="javascript: if (window.confirm(\'Delete file/dir?\')) window.location = \'?initial_files_path='.$initial_files_path.'&files_path='.$files_path.'&files_url='.$files_url.'&file_type='.$file_type.'&action=delete&file='.$file.'\';">x</a></td>';
              echo "</tr>\n";
              break;

          }//switch

        }else{ //directories
          if($file == ".."){ //parent directory
            if($files_path != $initial_files_path){
              echo "<tr><td colspan=\"2\"><b>\n";
              echo '<a href="?initial_files_path='.$initial_files_path.'&files_path='.$upper_dir_name.'&files_url='.$upper_dir_url.'&file_type='.$file_type.'">'.$file.'</a>';
              echo "</b></td></tr>\n";
            }
          }else{ //subdirectory
            echo "<tr><td><b>\n";
            echo '<a href="?initial_files_path='.$initial_files_path.'&files_path='.$files_path.$file.'/&files_url='.$files_url.$file.'/&file_type='.$file_type.'">'.$file.'</a></b></td>';
            echo '<td width="1"><a href="javascript: if (window.confirm(\'Delete file/dir?\')) window.location = \'?initial_files_path='.$initial_files_path.'&files_path='.$files_path.'&files_url='.$files_url.'&file_type='.$file_type.'&action=delete&file='.$file.'\';">x</a></td>';
            echo "</tr>\n";
          }
        }

      }
    }
    closedir($handle);
  }
?>

</table>
<!-- !list of remote files -->

</form>

</body>
</html>