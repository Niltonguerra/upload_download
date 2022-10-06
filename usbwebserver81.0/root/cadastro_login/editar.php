<?php
   include 'conexao.php';
		 
		 $usuario = $_POST [ "txt_usuario"];
         $senha = $_POST["txt_senha"];		
		
		      $sql =mysql_query ("update tb_login set senha='$senha where usuario='$usuario'") ; 
              echo "<center>";		  
		      echo "<hr>";
		      echo "CONTA ALTERADA COM SUCESSO !!!";
		      echo "<hr>";
		      echo "<br>";
	          echo "<a href=\"login.php\">RETORNAR AO LOGIN </a>"; 
?>
