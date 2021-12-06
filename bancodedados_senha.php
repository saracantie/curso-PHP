<?php

$erro = null;
$valido = false;

try{
    $connection = new PDO("mysql:host=localhost;dbname=cursophp","root","");
    $connection->exec("set names utf8");
}
catch(PDOException $e){
    echo "Falha: " . $e->getMessage();
    exit();
}

if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true) {

    if($_POST["senha"] !== $_POST["senhaRepete"]){

        $erro = "Senhas não batem";
        $erro .= "<br><a href='?id=". $_POST["id"] ."'>Tentar Novamente</a>";
        echo $erro;
        exit();
    
    }
    else{
        $valido = true;

        

        $sql = "UPDATE usuarios SET senha = ? WHERE id = ?"; 

        $stmt = $connection->prepare($sql);

        $passwordHash = md5($_POST["senha"]);
        $stmt->bindParam(1, $passwordHash); 
        
        $stmt->bindParam(2, $_POST["id"]);

        

        $stmt->execute();

        if($stmt->errorCode() != "00000"){ //0 valor 00000 significa sucesso
            $valido = false;
            $erro = "Erro código " . $stmt->errorCode() . ": ";
            $erro .= implode(", ", $stmt->errorInfo());           
        }
    }
}
else{ //AQUI É ONDE DIFERE DO CADASTRO. VERIFICA SE NAO EXISTE O VALIDAR, ENTAO RPESSUPOE QUE O USUARIO ESTA EDITANDO
    $rs = $connection->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
    $rs->bindParam(1, $_REQUEST["id"]);

    if($rs->execute()){
        if($registro = $rs->fetch(PDO::FETCH_OBJ)){
            $_POST["nome"] = $registro->nome;
            $_POST["email"] = $registro->email;
            
            
        }
        else{
            $erro = "Registro não encontrado";
        }
    }
    else{
        $erro = "Falha na captura do registro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterando Senhas em Banco de Dados</title>
</head>
<body>
    <?php
        if($valido == true){
            echo "Senha alterada com sucesso!";
            echo "<br><br>";
            echo "<a href='bancodedados_lista.php'>Visualizar Registros</a>";
        }
        else{
        

        if(isset($erro)){
            echo $erro . "<br><br>";
        }
    ?>
    <form method="POST" action="?validar=true&id="> 

        Nova senha para o usuário
        <?php
        echo $_POST["nome"];
        echo " (". $_POST["email"] .")";
        echo "<br>"
        
        ?>
        <br>
        Digite a senha:<br>
        <input type="password" name=senha><br><br>
        Digite a senha novamente:<br>
        <input type="password" name=senhaRepete><br>

        <input type="hidden" name = "id" value="<?php echo $_REQUEST["id"]; ?>">

        <input type="submit" value="Alterar">
    </form>
    <?php
        } //o else la de cima fechou só aqui
    ?>
</body>
</html>