<?php
$valor=$_GET["seleccionado"];
//echo $valor;
$codtip=$_GET["tipo"];
$ids = $_GET['ids'];
//var_dump($_GET);
$ano=$_GET["anos"];

?>	
	 <!--<select id='dia' name='dia'>-->
	 <select id='<?=$ids?>' name='<?=$ids?>'>
<?php	 
		
		$dia=1; 
	  	while(checkdate($valor,$dia,$ano)){
			if($dia<10)
				$dia="0".$dia;
		
?>		
		<option value="<?=$dia?>" <?php if($dia==$codtip){?>selected="selected"<?php }?> ><?=$dia?></option>
<?php	
		$dia++;	
		}
?>				
	</select>