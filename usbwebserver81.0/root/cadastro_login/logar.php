<?php
   
   include 'conexao.php';
		 
		 $usuario = $_POST["txt_usuario"];
		 $senha = $_POST["txt_senha"];
			 
		 $sql=mysql_query ("SELECT  * FROM tb_login 
		            WHERE (usuario='$usuario'  or email='$usuario') 
					and senha='$senha'"); 
		 if (mysql_num_rows($sql) > 0) {
		    echo "<center>";
			echo "<hr>";
			echo "CONTA LOGADA COM SUCESSO!"; 
			echo "<hr>"; 
            echo "<br>";
		    echo "<a href=\"listagem.php\">LISTA DE CONTAS </a>";}	
	    else {
		      echo "<center>";
			  echo "<hr>";
		      echo "LOGIN INVÁLIDO!!!"; 
              echo "<hr>";
			  echo "<br>";
			  echo "<a href=\"login.php\">VOLTAR </a>";}
?>