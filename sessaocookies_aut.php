<!--dependendo da versao do navegador se tiver ja enviado dados do ususario as funcoes session_star header ou cookies pode dar erro. entao antes do primeiro caractere da primeira linha abre tag php e trata como abaixo: -->
<?php
        ob_start(); //prede o cabeçalho, e no final do html libera
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessão e Cookies</title>
</head>
<body>
    <!--cuidar pq usuario pode manipular alterar o cookie-->
<?php
    if(isset($_COOKIE["visitas"])){
        $visitas = $_COOKIE["visitas"] +1;
    }
    else{
        $visitas =1;
    }

    setcookie("visitas", $visitas, time() + 30*24*60*60); //cookie permanece valido por 30 dias a n ser q ele limpe no hist de navegaçao

    echo "Essa é sua visita número " . $visitas . " em nosso site<br><br>";

    if(isset($_REQUEST["autenticar"]) && $_REQUEST["autenticar"] == true){
        $passwordHash = md5("blablablibli54321!!!palavrasdoidapragerarhashmelhor!" . $_POST["senha"]);

       try{
        $connection = new PDO("mysql:host=localhost;dbname=cursophp","root","");
        $connection->exec("set names utf8");
        }
        catch(PDOException $e){
        echo "Falha: " . $e->getMessage();
        exit();
        }

        $sql = "SELECT nome FROM usuarios WHERE email = ? AND senha = ?";
        $rs = $connection->prepare($sql);
        $rs->bindParam(1, $_POST["email"]);
        $rs->bindParam(2, $passwordHash);

        if($rs->execute()){
            if($registro = $rs->fetch(PDO::FETCH_OBJ)){
            session_start();
            $_SESSION["usuario"] = $registro->nome;

            header("Location: sessaocookies_conteudosigiloso.php");
            }
            else{
            echo "Dados inválidos";
            }
    }
    else{
        echo "Falha no acesso";
    }
    }





?>

    <form method="POST" action="?autenticar=true">
        E-mail: <input type="text" name="email" ><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" value="Autenticar">
    </form>

</body>
</html>

<?php
    ob_flush();
?>