<?php
include 'conexao.php';

if(isset($_POST ['busca_nome']) !="") {
    $sql = mysql_query("select * from tb_funcionarios where Nome_funcionario 
                        like   '{$_POST['busca_nome']}%' order by Nome_funcionario asc");

} else { 
    $sql= mysql_query ("select * from tb_funcionarios order by Nome_funcionario asc");
}


if(isset($_GET['apagar'])){
    $sql= mysql_query("delete from tb_funcionarios where Nome_funcionario=". $_GET['apagar']);
    echo "<br>";
    echo "<center>";
    echo "<hr>";
    echo "<Usuário excluido com sucesso>";
    echo "<br>";
    echo "<br>";
    echo "<a href=\"listagem.php\">Voltar</a>";
    echo "<hr>";
    return false;
}


?>


<html>
<body>
<center>
<form name="form1" method="POST" action="listagem.php">
    
   <th> Digite um usuario:
    <input type="text" name="busca_nome">
    <input type="submit" value="FILTRAR">
</form>

<table border="1" align="center">
    <tr>
        <th colspan="8" color="white" bgcolor="gray" > Cadastro De Funcionarios</th>

</th>
<tr>

    <th bgcolor="white"> numero de registro </th>
    <th bgcolor="white"> Nome do funcionario </th>
    <th bgcolor="white"> Data de admissao</th>
    <th bgcolor="white"> Cargo</th>
    <th bgcolor="white"> Salario bruto</th>
    <th bgcolor="white"> INSS</th>
    <th bgcolor="white"> Salario Liquido</th>
    <th bgcolor="white"> excluir</th>


</tr>
<tr>
    <?php
        while($linha = mysql_fetch_assoc($sql)) {
            ?>
            <td align="center"><?php echo $linha["n_registro"];?></td>
            <td align="center"><?php echo $linha["Nome_funcionario"];?></td>
            <td align="center"><?php echo $linha["data_admissao"];?></td>
            <td align="center"><?php echo $linha["cargo"];?></td>
            <td align="center"><?php echo $linha["salario_bruto"];?></td>
            <td align="center"><?php echo $linha["inss"];?></td>
            <td align="center"><?php echo $linha["salario_liquido"];?></td>
            <td align="center"><a href="listagem.php?apagar='<?php echo $linha['Nome_funcionario']; ?>'"><img src='users.png'></a></td>
            <tr>
    <?php }

            echo "<br>";
            echo "<center>";
            echo "<hr>";
            echo "<a href=\"formulariophp.html\">Retornar ao login </a>";
            echo "<hr>";
    ?>

        </table>
        </body>
        </html>



