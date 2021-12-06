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

    if(strlen(utf8_decode($_POST["nome"])) < 2){

        $erro = "Preencha o campo nome corretamente";
    }
    else if(strlen(utf8_decode($_POST["email"])) < 6){

        $erro = "Preencha email corretamente";
    }
    else if(is_numeric($_POST["idade"]) == false){

        $erro = "Preencha o campo idade corretamente";
    }
    else{
        $valido = true;

        

        $sql = "UPDATE usuarios SET nome = ?, email = ?, idade = ?, sexo = ?, estadocivil = ?, humanas = ?, exatas = ?, biologicas = ? WHERE id = ?"; 

        $stmt = $connection->prepare($sql);//PDO vai preparar o comando $sql para ser executado mas ainda n vai executar ate o execute

        $stmt->bindParam(1, $_POST["nome"]); //a interrogação numero 1 é associada o post nome e assim sussec
        $stmt->bindParam(2, $_POST["email"]);
        $stmt->bindParam(3, $_POST["idade"]);
        $stmt->bindParam(4, $_POST["sexo"]);
        $stmt->bindParam(5, $_POST["estadocivil"]);
        //o tinyint armazena 0 ou 1 (marcou 1 ou nao marcou 0 a caixinha):
        $checkhumanas = isset($_POST["humanas"]) ? 1 : 0;
        $stmt->bindParam(6, $checkhumanas);

        $checkexatas = isset($_POST["exatas"]) ? 1 : 0;
        $stmt->bindParam(7, $checkexatas);

        $checkbiologicas = isset($_POST["biologicas"]) ? 1 : 0;
        $stmt->bindParam(8, $checkbiologicas);
        
        $stmt->bindParam(9, $_POST["id"]);

        

        $stmt->execute();

        if($stmt->errorCode() != "00000"){ //0 valor 00000 significa sucesso
            $valido = false;
            $erro = "Erro código " . $stmt->errorCode() . ": ";
            $erro .= implode(", ", $stmt->errorInfo());           
        }
    }
}
else{ //AQUI É ONDE DIFERE DO CADASTRO. VERIFICA SE NAO EXISTE O VALIDAR, ENTAO RPESSUPOE QUE O USUARIO ESTA EDITANDO
    $rs = $connection->prepare("SELECT * FROM usuarios WHERE id = ?");
    $rs->bindParam(1, $_REQUEST["id"]);

    if($rs->execute()){
        if($registro = $rs->fetch(PDO::FETCH_OBJ)){
            $_POST["nome"] = $registro->nome;
            $_POST["email"] = $registro->email;
            $_POST["idade"] = $registro->idade;
            $_POST["sexo"] = $registro->sexo;
            $_POST["estadocivil"] = $registro->estadocivil;
            
            
            $_POST["humanas"] = $registro->humanas == 1 ? true : null;
            $_POST["exatas"] = $registro->exatas == 1 ? true : null;;
            $_POST["biologicas"] = $registro->biologicas == 1 ? true : null;;
            
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
    <title>Alterando Banco de Dados</title>
</head>
<body>
    <?php
        if($valido == true){
            echo "Dados alterados com sucesso!";
            echo "<br><br>";
            echo "<a href='bancodedados_lista.php'>Visualizar Registros</a>";
        }
        else{
        

        if(isset($erro)){
            echo $erro . "<br><br>";
        }
    ?>
    <form method="POST" action="?validar=true"> <!--se o action aponta pro mesmo arquivo da pra omitir e começar direto da ?-->
        Nome:
        <input type="text" name="nome"
        <?php if(isset($_POST["nome"])) {echo"value='". $_POST["nome"] ."'";} ?>><br>

        E-mail:
        <input type="text" name="email"
        <?php if(isset($_POST["email"])) {echo"value='". $_POST["email"] ."'";} ?>><br>

        Idade:
        <input type="text" name="idade"
        <?php if(isset($_POST["idade"])) {echo"value='". $_POST["idade"] ."'";} ?>><br>

        Sexo:
        <input type="radio" name="sexo" value="F" <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") {echo"checked";} ?>>Feminino
        <input type="radio" name="sexo" value="M" <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") {echo"checked";} ?>>Masculino
        <br>

        Interesses:
        <input type="checkbox" name="humanas"<?php if(isset($_POST["humanas"])){echo"checked";}?>>Ciências Humanas
        <input type="checkbox" name="exatas"<?php if(isset($_POST["exatas"])){echo"checked";}?>>Ciências exatas<input type="checkbox" name="biologicas"<?php if(isset($_POST["biologicas"])){echo"checked";}?>>Ciências Biológicas
        <br>

        Estado Civil
        <select name="estadocivil">
            <option>Selecione</option>
            <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo"selected";} ?>>Solteiro(a)</option>
            <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)") {echo"selected";} ?>>Casado(a)</option>
            <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorciado(a)") {echo"selected";} ?>>Divorciado(a)</option>
            <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viúvo(a)") {echo"selected";} ?>>Viúvo(a)</option>
        </select>
        <br>

        <input type="hidden" name = "id" value="<?php echo $_REQUEST["id"]; ?>">

        <input type="submit" value="Alterar">
    </form>
    <?php
        } //o else la de cima fechou só aqui
    ?>
</body>
</html>