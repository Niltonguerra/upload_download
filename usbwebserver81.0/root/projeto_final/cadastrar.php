<?php 

    include 'conexao.php';
    $usuario = $_POST ["txt_usuario"];
    $email = $_POST ["txt_email"];
    $sexo = $_POST ["txt_sexo"];
    $senha = $_POST ["txt_senha"];
    $sql =mysql_query ("SELECT * FROM cadastro WHERE usuario='$usuario' or email='$email'");
    if (mysql_num_rows($sql) > 0) {
        echo "<center>";
        echo "<hr>";
        echo "CONTA EXISTENTE!!!";
        echo "<hr>";
        echo "<br>";
    } else {
        $sql=mysql_query ("INSERT INTO cadastro
                        (usuario,sexo,email,senha) VALUES ('$usuario','$sexo', '$email', '$senha')");
            echo "<center>";
            echo "<hr>";
            echo "CONTA CRIADA COM SUCESSO!!!";
            echo "<hr>";
            echo "<br>";
    }

?>