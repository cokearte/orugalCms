<?php

class BaseDatos	{
/*	var $tipo 		= "mssql";
	var $host 		= "POLLUX";
	var $usuario 	= "lagobo";
	var $passwd 	= "lagobo";
	var $nombre 	= "lagobo";	
*/

	var $tipo 		= "mysql";
	var $host 		= "localhost";
	var $usuario 	= "root";
	var $passwd 	= "";
	var $nombre 	= "dre";	
	
/*	var $host 		= "209.126.192.194";
	var $usuario 	= "dre";
	var $passwd 	= "drebd05";
	var $nombre 	= "dre";	
*/	
	function connect()	{
		if ($this->tipo == "mysql")	{
			$this->conn	= mysql_connect($this->host,$this->usuario,$this->passwd);
			$this->lnk  = mysql_select_db($this->nombre,$this->conn);
		}
		elseif ($this->tipo == "odbc")	{
			$this->conn	= odbc_connect($this->nombre,$this->usuario,$this->passwd);
		}		
		elseif ($this->tipo == "mssql")	{
			$this->conn	= mssql_connect($this->host,$this->usuario,$this->passwd);
			$this->lnk  = mssql_select_db($this->nombre,$this->conn);
		}
	}
	
	function query($sql_query)	{
//		echo $sql_query . "<br>";
		if ($this->tipo == "mysql")	{
			return mysql_query($sql_query,$this->conn);
		}
		elseif ($this->tipo == "odbc")	{
			return odbc_exec($this->conn,$sql_query);
		}				
		elseif ($this->tipo == "mssql")	{
			return mssql_query($sql_query,$this->conn);
		}
	}
	
	function fetch_row($recdset)	{
		if ($this->tipo == "mysql")	{
			return mysql_fetch_array($recdset);
		}
		elseif ($this->tipo == "odbc")	{
			return $this->odbc_fetch_array($recdset);
		}
		elseif ($this->tipo == "mssql")	{
			return mssql_fetch_array($recdset);
		}
	}
	
	function numrows($res)	{
		return mssql_num_rows($res);
	}
	
	function formato_fecha($dia,$mes,$ano)	{
		if ($this->tipo == "mysql")	{
			return $ano."-".$mes."-".$dia;
		}
		elseif ($this->tipo == "mssql")	{
			return $mes."-".$dia."-".$ano;
		}
	}
	
	function odbc_fetch_array($result, $rownumber=-1) {
		if (PHP_VERSION > "4.1") {
			if ($rownumber < 0) {
			    odbc_fetch_into($result, &$rs);
			} else {
			    odbc_fetch_into($result, &$rs, $rownumber);
			}
		} else {
			  odbc_fetch_into($result, $rownumber, &$rs);
		}
		foreach ($rs as $key => $value) {
			//echo ">>";
			$rs_assoc[odbc_field_name($result, $key+1)] = $value;
		}
		return $rs_assoc;
	}

	
}


/// Funciónes para Resaltar En función Buscar
 function Removeaccents($string){
         $string= strtr($string, "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
         "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
         return $string;
}

function Resaltar($temporal,$cadena){
     if(strlen($cadena)>2) {
          $temporal= str_replace(strtolower($cadena),"<b class=encontrado>".strtolower($cadena)."</b>",$temporal);
          $temporal= str_replace(strtoupper($cadena),"<b class=encontrado>".strtoupper($cadena)."</b>",$temporal);
          $temporal= str_replace(ucwords($cadena),"<b class=encontrado>".ucwords($cadena)."</b>",$temporal);
          $temporal= str_replace(ucfirst($cadena),"<b class=encontrado>".ucfirst($cadena)."</b>",$temporal);

          $cadena=Removeaccents($cadena);
          $temporal= str_replace(strtolower($cadena),"<b class=encontrado>".strtolower($cadena)."</b>",$temporal);
          $temporal= str_replace(strtoupper($cadena),"<b class=encontrado>".strtoupper($cadena)."</b>",$temporal);
          $temporal= str_replace(ucwords($cadena),"<b class=encontrado>".ucwords($cadena)."</b>",$temporal);
          $temporal= str_replace(ucfirst($cadena),"<b class=encontrado>".ucfirst($cadena)."</b>",$temporal);

          $temporal= trim(chop($temporal));
     } else {}
     return $temporal;
}
//Fin de funciones para Resaltar

//Función Buscar
function Buscar($cadena){

   $excluir=array(4,5,6,37);
   $numExc = count($excluir);

   if ($numExc){
     for ($idx=0;$idx<$numExc;$idx++){
        $plussql .= sprintf(" and idcategoria!='%s'",$excluir[$idx]);
     }
   }

   global $valacti;
   global $nombre;
   global $id;

   $valacti = 0;

   $cadena = strtolower($cadena);
		$response = array();
		$listar_dest = new BaseDatos;
		$listar_dest->connect();
		
		//$res1="select * from dre_subcategorias where dre_subcat_nombre like '%".$cadena."%'";
		//echo "Query : ".$res1; 
//		$res = $listar_dest->query("select * from dre_subcategorias where dre_subcat_nombre like '%".$cadena."%'"); 
		//echo "Query : ".$listar_dest->query; 

		$res = $listar_dest->query("select sub.*,cat.dre_categoria_nombre from dre_subcategorias sub,dre_categorias cat
		 where cat.dre_categoria_id=sub.dre_categoria_id
		  and sub.dre_subcat_nombre like '%".$cadena."%'
		   or cat.dre_categoria_nombre like '%".$cadena."%'
		    group by sub.dre_subcat_id
			 order by sub.dre_categoria_id"); 
  
    printf("<div class=Estilo6>BUSQUEDA REALIZADA POR: <i>%s</i></div><br>",$cadena);

		while ($row = $listar_dest->fetch_row($res))	{

//   while ($row = mysql_fetch_array($query)) {
//       ValidarActiva($row['IDCATEGORIA']);
/*       if($valacti){
*/
//         $idcategoria= $row['IDCATEGORIA'];
         $dre_subcat_nombre = $row['dre_subcat_nombre'];
         $dre_subcat_id = $row['dre_subcat_id'];
         $dre_subcat_dir = $row['dre_subcat_dir'];
         $dre_categoria_nombre = $row['dre_categoria_nombre'];
		 

         $dre_subcat_nombre= strip_tags($dre_subcat_nombre);
         $dre_categoria_nombre= strip_tags($dre_categoria_nombre);
         $dre_subcat_dir= strip_tags($dre_subcat_dir);		 

         if ($dre_categoria_nombre){
           $arreglo = explode(strtolower($cadena),strtolower($dre_categoria_nombre));
         }


         if ($dre_subcat_nombre){
           $arreglo .= explode(strtolower($cadena),strtolower($dre_subcat_nombre));
         }

         if ($dre_subcat_dir){
           $arreglo .= explode(strtolower($cadena),strtolower($dre_subcat_dir));
         }


         $nombre="";
         $id="";

         printf("<table border=0 width=95%s align=center cellpadding=3 cellspacing=3><tr><td class=titulo_pagina_buscar>","%");

//         DisplayMigasBuscar($idcategoria,$cadena);

//         printf("<tr><td class=texto_pagina_buscar align=center>BUSQUEDA REALIZADA POR: %s</td></tr>",$buscar);
         printf("<tr><td class=texto_pagina_buscar>");

//       if($autor) {printf("AUTOR: %s<br>",Resaltar($autor,$cadena));}

         if (count($arreglo)>1){

           $centro = 0;

           for ($idx=0;$idx<count($arreglo)-1;$idx++){
             $centro  = $centro + strlen($arreglo[$idx]) + floor(strlen($cadena));
             $centro1 = ($centro50)?50:$centro;
             $inicio  = $centro1 - 50;
             $temporal =substr(trim($dre_categoria_nombre),$inicio,100);
             printf("...%s...br>",Resaltar($temporal,$cadena));
           }


           for ($idx=0;$idx<count($arreglo)-1;$idx++){
             $centro  = $centro + strlen($arreglo[$idx]) + floor(strlen($cadena));
             $centro1 = ($centro50)?50:$centro;
             $inicio  = $centro1 - 50;
             $temporal =substr(trim($dre_subcat_nombre),$inicio,100);
             printf("...%s...br>",Resaltar($temporal,$cadena));
           }

           for ($idx=0;$idx<count($arreglo)-1;$idx++){
             $centro  = $centro + strlen($arreglo[$idx]) + floor(strlen($cadena));
             $centro1 = ($centro50)?50:$centro;
             $inicio  = $centro1 - 50;
             $temporal =substr(trim($dre_subcat_dir),$inicio,100);
             printf("...%s...</a><br>",Resaltar($temporal,$cadena));
           }

           for ($idx=0;$idx<count($arreglo)-1;$idx++){
             $centro  = $centro + strlen($arreglo[$idx]) + floor(strlen($cadena));
             $centro1 = ($centro50)?50:$centro;
             $inicio  = $centro1 - 50;
             $temporal =substr(trim($entradilla),$inicio,100);
             printf("...%s...br>",Resaltar($temporal,$cadena));
           }

         } else {

          
		   $dre_categoria_nombre = substr(strip_tags($dre_categoria_nombre),0,100);
           printf("<a href=ciudad_subcat.php?dre_subcat_id=%s&dre_categoria_id=1 class=texto_pagina_link>%s</a>....",$dre_subcat_id,Resaltar($dre_categoria_nombre,$cadena));
//           printf("%s<br>",Resaltar($descripcion,$cadena));
		   $dre_subcat_nombre = substr(strip_tags($dre_subcat_nombre),0,100);
           printf("<a href=ciudad_subcat.php?dre_subcat_id=%s&dre_categoria_id=1 class=texto_pagina_link>%s</a>....",$dre_subcat_id,Resaltar($dre_subcat_nombre,$cadena));
//           printf("%s<br>",Resaltar($descripcion,$cadena));
           $dre_subcat_dir = substr(strip_tags($dre_subcat_dir),0,100);
           printf("<a href=productos/index.php?idproducto=%s class=texto_pagina_link>%s</a><br>",$dre_subcat_id,Resaltar($dre_subcat_dir,$cadena));
//           printf("%s<br>",Resaltar($entradilla,$cadena));
           $entradilla = substr(strip_tags($entradilla),0,100);
           printf("<a href=productos/index.php?idproducto=%s class=Estilo3>%s</a><br>",$idproducto,Resaltar($entradilla,$cadena));
//           printf("%s<br>",Resaltar($entradilla,$cadena));
         }

         printf("</td></tr></table>");
       }

   }


?>
