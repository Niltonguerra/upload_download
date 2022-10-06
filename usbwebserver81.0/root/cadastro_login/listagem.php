<?php

include 'conexao.php';


if(isset($_POST['busca_nome']) != '') {
	$sql = mysql_query("select * from tb_login where usuario like  '{$_POST['busca_nome']}%' order by usuario asc");
} else {
	$sql = mysql_query("select * from tb_login order by usuario asc");
}


if(isset($_GET['apagar'])){
	$sql = mysql_query("delete from tb_login where usuario=". $_GET['apagar']);
	 echo "<br>";
	 echo "<center>";
	 echo "<hr>";
	 echo "USU�RIO EXCLU�DO COM SUCESSO!!!";
	 echo "<br>";
	 echo "<br>";
	 echo "<a href=\"listagem.php\">VOLTAR</a>"; 
	 echo "<hr>";
	return false;
}

?>

<html>
<body>	  
<center>
<form name="form1" method="POST" action="listagem.php">
DIGITE UM USU�RIO: <input type="text" name="busca_nome"><input type="submit" value="FILTRAR">
</form>


<table border="1" align="center">
		    <tr>
			<th colspan="6e" bgcolor="orange">LISTAGEM DE CONTAS CADASTRADAS</th>
			</tr>
			<tr>
			<th bgcolor="yellow">USU�RIO</th>
			<th bgcolor="yellow">E-MAIL</th>
			<th bgcolor="yellow">SENHA</th>
			<th bgcolor="yellow">APAGAR</th>
			<th bgcolor="yellow">EDITAR</th>
			</tr>
			<tr>
			
			<?php
				while($linha = mysql_fetch_assoc($sql)) {
			?>
			<td align="center"><?php echo $linha['usuario']; ?></td>
			<td align="center"><?php echo $linha['email']; ?></td>
			<td align="center"><?php echo $linha['senha']; ?></td>
	       <th><a href="listagem.php?apagar='<?php echo $linha['usuario']; ?>'"><img src='deletar_usuario.png'></a></th>
		   <th><a href="editar_conta.php?edit=<?php echo $linha['usuario']; ?>&email=<?php echo $linha['email']; ?>&senha=<?php echo $linha['senha']; ?>"><img src='edicao_usuario.png'></a></th>
	       <tr>
            			
			<?php  } 
			  
			  echo "<br>";
			  echo "<center>";
			  echo "<hr>";
		      echo "<a href=\"login.php\">RETORNAR AO LOGIN </a>"; 
			  echo "<hr>";
			?>
</table>
</body>
</html>





