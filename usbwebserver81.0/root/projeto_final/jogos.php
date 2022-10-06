<?php
include ("conexao.php");
$usuario = $_POST ["txt_usuario"];
$senha = $_POST ["txt_senha"];
$sql =mysql_query ("SELECT * FROM cadastro WHERE (usuario='$usuario' or email='$usuario') and senha='$senha' ");
if (mysql_num_rows($sql) > 0)  {
}                       
else {
        echo "<center>";
        echo "<hr>";
        echo "LOGIN INVALIDO!";
        echo "<hr>";
        echo "<br>";
        echo "<a href=\"login.php\">VOLTAR <\a>";
       exit;
}
?>


<?php
//o usbserver envia até 1.75MB em arquivos
include("zipar.class.php");
include ("conexao.php");


if(isset($_FILES['arquivo'])){
    // echo "arquivo enviado";
    $arquivo = $_FILES['arquivo'];      
    $pasta = "arquivos/";
    $nomedoarquivo = $arquivo['name'];
    $extensao = pathinfo($nomedoarquivo, PATHINFO_EXTENSION); //descobre o tipo do arquivo
    $extensao = strtolower(pathinfo($nomedoarquivo,PATHINFO_EXTENSION)); //transforma tudo em letras minusculas
    $novonomedoarquivo = md5(time()) . $extensao; //gera um novo nome do arquivo, para evitar que aconteça conflitos no banco de dados 
    $path = $pasta . $novonomedoarquivo . "." . $extensao;
    if($extensao != "jpg" && $extensao != "png"){
        die("insira apenas arquivos tipo '.png' ou '.jpg'");
    }
    if($arquivo['size'] > 1572864){
        die("Arquivos muito grande!! max:1,5MB");
    }                                                              //o ponto concatena as variaveis

    if($deu_certo = move_uploaded_file($arquivo["tmp_name"], $pasta . $novonomedoarquivo . "." . $extensao)){ //a função move_uploaded_file retorna uma variavel booleana
        $zip = new Zipar();
        $zip->ziparArquivos($novonomedoarquivo . "." . $extensao,$novonomedoarquivo . "." . $extensao .".zip",$pasta);     
        unlink($pasta . $novonomedoarquivo . "." . $extensao);
    }
    $novonome = $novonomedoarquivo . "." . $extensao .".zip";
    if($deu_certo){
        $sql=mysql_query("INSERT INTO arquivos(nome,path,data_upload,novonome) VALUES('$nomedoarquivo','$path',NOW(),'$novonome')");
        echo "<p> Arquivo enviado com sucesso!</p>";
        //echo "<p> Arquivo enviado com sucesso! Para acesá-lo, clique aqui: <a target='_blank' href='arquivos/$novonomedoarquivo.$extensao'>clique aqui.</a></p>";
    }
    else
            echo "<p>Falha ao enviar arquivo</p>";
    }           
    
    
$sql = mysql_query("SELECT * FROM arquivos");


if(isset($_GET['apagar'])){
    if(isset($_GET['delete'])){
        $sql = mysql_query("delete from arquivos where novonome=". $_GET['apagar']);
        unlink("C:/Users/labs/Desktop/usbwebserver81.0/usbwebserver81.0/root/projeto_final/arquivos/".$_GET['delete']);
        echo $_GET['apagar'];
        echo "<br>";
        echo "<center>";
        echo "<hr>";
        echo "Arquivo excluido com sucesso!!!";
        echo "<br>";
        echo "<br>";
        echo "<a href=\"jogos.php\">VOLTAR</a>"; 
        echo "<hr>";
        return false;
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js.js" defer></script>
    <title>Aluno</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/tooplate-gymso-style.css">
    <link rel="stylesheet" href="css/nilton.css">
</head>
</head>



<body data-spy="scroll" data-target="#navbarNav" data-offset="50"  >
<section class="hero d-flex flex-column justify-content-center align-items-center" id="home" width=100%>

    <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
            
                <a class="navbar-brand" href="index.html">Dream Creators</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item">
                            <a href="#home" class="nav-link smoothScroll"></a>
                        </li>

                        <li class="nav-item">
                            <a href="#about" class="nav-link smoothScroll"></a>
                        </li>

                        <li class="nav-item">
                            <a href="#class" class="nav-link smoothScroll"></a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#schedule" class="nav-link smoothScroll"></a>
                        </li>

                        <li class="nav-item">
                            <a href="login.php" class="nav-link smoothScroll"><img src='images/usuario.png' width=24px></a>
                        </li>
                    </ul>

                    <ul class="social-icon ml-lg-3">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>

            </div>
        </nav>
</class>  

    <form method="POST" enctype="multipart/form-data" action="">
    
            <div id="caixa">
                <p><label for=""class="texto">Selecione o Arquivo </label><p>
                <input name="arquivo" type="file" id="campo"></p>
                <button name="upload" type="submit">Enviar arquivo</button>
            </div>
            </form>
                <br><br>
            <table class="tabela" border="1" cellpadding="10" >
                <thead>
                    <th>Download</th>
                    <th>Data de envio </th>
                    <th>Excluir </th>
                </thead>
                <tbody>
                <?php
                while($linha =mysql_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td><a href="<?php echo $linha['path']. ".zip";?>" class="tabela" download ><?php echo $linha['nome']; ?></a> </td>
                        <td><?php echo date_default_timezone_set('America/Sao_Paulo'),($linha['data_upload']); ?></td>
                        <th><a href="?apagar='<?php echo $linha['novonome']; ?>'&delete=<?php echo $linha['novonome']; ?>" > <img src='images/deletar.png'></a></th>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

    </section>
</body>

</html>