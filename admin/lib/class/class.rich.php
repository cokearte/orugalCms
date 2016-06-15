<?php
/*
Rich Editor trial version, Version 1.1
Copyright (c) 2002-2003 V. Smolin All rights reserved.
http://www.chel.tv/rich/
smolin@chel.tv
*/

$rich_flag = false;

class rich{
  var $caption;
  var $name;
  var $value;
  var $width;
  var $height;
  var $files_path;
  var $files_url;
  var $page_mode;

  var $classname;

  function rich($caption, $name, $value='', $width='', $height='',
                    $files_path='/', $files_url='/', $page_mode=false){
      $this->caption = $caption;
      $this->name = $name;
      $this->width = $width;
      $this->height = $height;

	  $this->files_path = $_SERVER['DOCUMENT_ROOT'].$files_path;
//      $this->files_path = "../".$files_path;
      $this->files_url = $files_url;

      $this->page_mode = $page_mode;
      if(!$this->page_mode) $value = '<body>'.$value.'</body>';
      $this->value = htmlspecialchars($value);

      $this->classname = "rich";
  }
  function draw(){

    global $class_path;
    global $rich_flag;

    //name of textarea element for sending text from form
    $name_area = $this->name;

    $name = $this->name."_ed"; //editor name
    $name_id = $name."_id";    //id of editor element

    echo $this->caption.":<br>";

    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if(!$user_agent) $user_agent = $GLOBALS["HTTP_USER_AGENT"];

    //$is_msie == true, if current brouser is MSIE
    if(ereg("MSIE ([0-9|\.]+)", $user_agent, $regs)){
      $is_msie = true;
      $msie_version = (double)$regs[1];
    }else $is_msie = false;

    echo '<!-- editor body -->
<table border="1" cellspacing="0" cellpadding="0" width="'.$this->width.'" height="'.$this->height.'">
';

    if($is_msie){

echo '<tr><td>

<!-- toolbar -->
<table bgcolor="buttonface" border="0" cellspacing="0" cellpadding="0" width="100%">
<tr onmousedown="mouse_down(true);" onmouseup="mouse_down(false);" onmouseover="mouse_over(true);" onmouseout="mouse_over(false);" ondragstart="return false;"><td class="toolbar">

<nobr>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Cut\')" alt="Cut" src="'.$class_path.'rich_files/images/cut.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Copy\')" alt="Copy" src="'.$class_path.'rich_files/images/copy.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Paste\')" alt="Paste" src="'.$class_path.'rich_files/images/paste.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Undo\')" alt="Undo" src="'.$class_path.'rich_files/images/undo.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Redo\')" alt="Redo" src="'.$class_path.'rich_files/images/redo.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="Bold_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Bold\')" alt="Bold" src="'.$class_path.'rich_files/images/bold.gif" align="absMiddle" width="20" height="20">
  <img id="Italic_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Italic\')" alt="Italic" src="'.$class_path.'rich_files/images/italic.gif" align="absMiddle" width="20" height="20">
  <img id="Underline_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Underline\')" alt="Underline" src="'.$class_path.'rich_files/images/underline.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="JustifyLeft_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyLeft\')" alt="JustifyLeft" src="'.$class_path.'rich_files/images/left.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyCenter_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyCenter\')" alt="JustifyCenter" src="'.$class_path.'rich_files/images/center.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyRight_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyRight\')" alt="JustifyRight" src="'.$class_path.'rich_files/images/right.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyFull_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyFull\')" alt="JustifyFull" src="'.$class_path.'rich_files/images/justify.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="InsertOrderedList_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertOrderedList\')" alt="InsertOrderedList" src="'.$class_path.'rich_files/images/numlist.gif" align="absMiddle" width="20" height="20">
  <img id="InsertUnorderedList_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertUnorderedList\')" alt="InsertUnorderedList" src="'.$class_path.'rich_files/images/bullist.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Outdent\')" alt="Outdent" src="'.$class_path.'rich_files/images/outdent.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Indent\')" alt="Indent" src="'.$class_path.'rich_files/images/indent.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertHorizontalRule\')" alt="Insert Horizontal Line" src="'.$class_path.'rich_files/images/h_line.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'RemoveFormat\')" alt="Remove Formatting" src="'.$class_path.'rich_files/images/rem_format.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateTable\')" alt="Create Table" src="'.$class_path.'rich_files/images/table.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertRow\')" alt="Insert Row" src="'.$class_path.'rich_files/images/insrow.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'DeleteRow\')" alt="Delete Row" src="'.$class_path.'rich_files/images/delrow.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertColumn\')" alt="Insert Column" src="'.$class_path.'rich_files/images/inscol.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'DeleteColumn\')" alt="Delete Column" src="'.$class_path.'rich_files/images/delcol.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="text">Paragraph:</span>
<select class="text" id="FormatBlock_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FormatBlock\',this)">';

    if($msie_version < 6){
      echo '
  <option value="<P>">Normal (P)</option>
  <option value="<H1>">Heading 1 (H1)</option>
  <option value="<H2>">Heading 2 (H2)</option>
  <option value="<H3>">Heading 3 (H3)</option>
  <option value="<H4>">Heading 4 (H4)</option>
  <option value="<H5>">Heading 5 (H5)</option>
  <option value="<H6>">Heading 6 (H6)</option>
  <option value="<PRE>">Preformatted (PRE)</option>';
    }else{
      echo '
  <option value="Normal">Normal (P)</option>
  <option value="Heading 1">Heading 1 (H1)</option>
  <option value="Heading 2">Heading 2 (H2)</option>
  <option value="Heading 3">Heading 3 (H3)</option>
  <option value="Heading 4">Heading 4 (H4)</option>
  <option value="Heading 5">Heading 5 (H5)</option>
  <option value="Heading 6">Heading 6 (H6)</option>
  <option value="Formatted">Preformatted (PRE)</option>';
    }

    echo '
</select>
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="text">Font:</span>
<select class="text" id="FontName_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FontName\',this)">
  <option value="Arial">Arial</option>
  <option value="Arial Black">Arial Black</option>
  <option value="Garamond">Garamond</option>
  <option value="Comic Sans MS">Comic Sans MS</option>
  <option value="Courier New">Courier New</option>
  <option value="Times New Roman" selected>Times New Roman</option>
  <option value="Verdana">Verdana</option>
  <option value="Webdings">Webdings</option>
  <option value="Wingdings">Wingdings</option>
</select>
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="text">Class:</span>
<select class="text" id="ClassName_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'ClassName\',this)">
  <option value=""></option>
</select>
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="text">Size:</span>
<select class="text" id="FontSize_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FontSize\',this)">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3" selected>3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
</select>
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'ForeColor\')" alt="Text Color" src="'.$class_path.'rich_files/images/fgcolor.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'BackColor\')" alt="Background color" src="'.$class_path.'rich_files/images/bgcolor.gif" align="absMiddle" width="20" height="20">
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateImage\')" alt="Create Image" src="'.$class_path.'rich_files/images/image.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateLink\')" alt="Create Link" src="'.$class_path.'rich_files/images/link.gif" align="absMiddle" width="20" height="20">
  <img class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'PasteWord\')" alt="Paste from Word" src="'.$class_path.'rich_files/images/paste_word.gif" align="absMiddle" width="20" height="20">
  <img id="SwitchBorders_'.$name.'" class="tbImage_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'SwitchBorders\')" alt="SwitchBorders" src="'.$class_path.'rich_files/images/borders.gif" align="absMiddle" width="20" height="20">
';

echo '
</nobr>

<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="text">Source:</span><input type="checkbox" name="edit_mode" onClick="active_rich = '.$name_id.'; change_mode();">
</nobr>

</td></tr>
</table>
<!-- toolbar -->

</td></tr>';

    }

echo '

<tr><td height="100%">

<!-- text -->
';

    if($is_msie){
      echo '<iframe class="editor" name="'.$name.'" id="'.$name_id.'" style="border: black thin; width:100%; height:100%">&nbsp;</iframe>';
    }

    echo '

<textarea name="'.$name_area.'" id="'.$name.'_area_id" rows="10" cols="30" onKeyDown="contador(this.form.promocion_abstract,200);" onKeyUp="contador(this.form.promocion_abstract,200);" style="' ;
    if($is_msie) echo 'display:none; ';
    echo 'border: black thin; height=50%; width=70%">'.$this->value.'</textarea>
<!-- text -->

</td></tr>

</td></tr>
</table>
<!-- editor body -->
';

    if($is_msie){

      if(!$rich_flag){
        echo '
<div id="rich_temp_div" contenteditable="true" class="paste_div"></div>
';
      }

      echo '

<script language="javascript">
  '.$name.'_area_id = document.all.'.$name.'_area_id;

  '.$name.'_id.document.designMode = "On";

  '.$name.'_id.document.open();
  '.$name.'_id.document.write('.$name.'_area_id.value);
  '.$name.'_id.document.close();

  active_rich = '.$name_id.';
  set_stylesheet_rules();

  '.$name_id.'.document.oncontextmenu = function(){
active_rich='.$name_id.';
parse_context();
return false;
                                   }
  '.$name_id.'.document.onkeyup = function(){
active_rich = '.$name_id.';
change_toolbar_state();
                                   }
  '.$name_id.'.document.onclick = function(){
active_rich = '.$name_id.';
change_toolbar_state();
                                   }
  '.$name_id.'.document.onfocus = function(){
active_rich = '.$name_id.';
change_toolbar_state();
                                   }

  '.$name.'_rich_mode = true;
  '.$name.'_rich_page_mode = '.(int)$this->page_mode.';
  '.$name.'_rich_border_mode = false;

  '.$name.'_files_path = "'.$this->files_path.'";
  '.$name.'_files_url = "'.$this->files_url.'";';
    }

    if($is_msie){
      if(!$rich_flag){

    echo '

/* copyright

Rich Editor trial version, Version 1.1
Copyright (c) 2002-2003 V. Smolin All rights reserved.
http://www.chel.tv/rich/
smolin@chel.tv

copyright */
';

        echo '
      rich_path = "'.$class_path.'rich_files/";
        ';
        $rich_flag = true;
      }
    }

    echo '</script>';
  }

}

?>