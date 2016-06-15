<?php 
session_start();
if(isset($_GET['salidaAfiliado']))
{
	unset($_SESSION['afiliado']);
	echo "<script>document.location='"._DOMINIO."afiliados'</script>";
}
//valido si existe la session del usuario afiliado
if(isset($_SESSION['afiliado']))
{
	include("archivos.php");
}
else
{
	include("login.php");
}
?>