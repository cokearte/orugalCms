<?php 
class archivos
{
	var $query;
	var $result;
	function archivos()
	{

	}
	function verificaSession($usuario,$clave)
	{
		global $db;
		$this->query		=	sprintf("SELECT * FROM usuarios WHERE username='%s' AND contrasena=sha1('%s') AND perfil=2",$usuario,$clave);
		$this->result 		=	$db->GetAll($this->query);
		return $this->result;
	}
}

 ?>