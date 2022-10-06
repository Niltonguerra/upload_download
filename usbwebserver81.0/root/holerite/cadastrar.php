<?php
include 'conexao.php';
$n_registro = $_POST ["n_registro"];
$nome_funcionario = $_POST ["nome_funcionario"];
$data_adimissao = $_POST ["data_adimissao"];
$cargo = $_POST ["cargo"];
$qtde_salarios = $_POST ["qtde_salarios"];

$sql =mysql_query ("SELECT * FROM tb_funcionarios
                    WHERE n_registro='$n_registro' 
                    or nome_funcionario='$nome_funcionario'");

if (mysql_num_rows ($sql) > 0) {
    echo "<center>";
    echo "<hr>";
    echo "CONTA EXISTENTE!!!";
    echo "<hr>";
    echo "<br>";
}

else { 
$salario_bruto =$qtde_salarios * 1212;
$inss = $salario_bruto*0.11;
$salario_liquido = 0;


if($salario_bruto >= 1350) {
	
	$inss = $salario_bruto*0.11;
	$salario_liquido = $salario_bruto-$inss;
}
if($salario_bruto <= 1350){
	
	$salario_liquido = $salario_bruto;
	
}
	
	
    $sql=mysql_query ("INSERT INTO tb_funcionarios
                        (n_registro,Nome_funcionario,data_admissao,cargo,qtde_salarios,salario_bruto,inss,salario_liquido)
                        VALUES ('$n_registro','$nome_funcionario','$data_adimissao','$cargo','$qtde_salarios','$salario_bruto','$inss','$salario_liquido')") ;
    echo "<center>";
    echo "<hr>";
    echo "Conta criada com sucesso!!!";
    echo "<hr>";
    echo "<br>";
}
?>