<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contas - PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <form class="cadastro" name="form1" method="post">

        <div class="form">
            <h1>Cadastro Contas</h1>

            <label for="nome">Usuario ou E-mail: </label>
            <input type="text" name="txt_usuario" size="30" id="nome">

            <label for="senha">Senha: </label>
            <input type="password" name="txt_senha" size="10" id="senha">
            <br>
            <input type="submit" value="Entrar" onclick="document.form1.action='jogos.php'" class="enviar">
			<a href='cadastro.html'>nova Conta</a>
		</div>

    </form>

</body>
</html>