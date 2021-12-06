<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem do Banco de Dados</title>
</head>
<body>
    <table border=1>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Idade</th>
            <th>Sexo</th>
            <th>Estado Civil</th>
            <th>Humanas</th>
            <th>Exatas</th>
            <th>Biológicas</th>
            <th>Hash da Senha</th>
            <th>Ações</th>
        </tr>
<?php
//primeiro conectar com o banco, try catch
try{
    $connection = new PDO("mysql:host=localhost;dbname=cursophp","root","");
    $connection->exec("set names utf8");
}
catch(PDOException $e){
    echo "Falha: " . $e->getMessage();
    exit();
}

if(isset($_REQUEST["excluir"]) && $_REQUEST["excluir"] == true){
    $stmt = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bindParam(1, $_REQUEST["id"]);
    $stmt->execute();

    if($stmt->errorCode() != "00000"){
        echo "Erro código " . $stmt->errorCode() . ": ";
        echo implode(", ", $stmt->errorInfo());
    }
    else{
        echo "Sucesso: usuário removido com sucesso <br><br>";
    }
}

$rs = $connection->prepare("SELECT * FROM usuarios");
if($rs->execute()){//retorna valor booleano, se a operaçao foi realizada ou nao
    while($registro = $rs->fetch(PDO::FETCH_OBJ)){
        echo "<tr>";

        echo "<td>" . $registro->nome . "</td>";
        echo "<td>" . $registro->email . "</td>";
        echo "<td>" . $registro->idade . "</td>";
        echo "<td>" . $registro->nome . "</td>";
        echo "<td>" . $registro->estadocivil . "</td>";
        echo "<td>" . $registro->humanas . "</td>";
        echo "<td>" . $registro->exatas . "</td>";
        echo "<td>" . $registro->biologicas . "</td>";
        echo "<td>" . $registro->senha . "</td>";
        
        echo "<td>";
        echo "<a href='?excluir=true&id=". $registro->id . "'>(exclusão)</a>";

        echo "<a href='bancodedados_alterar.php?id=". $registro->id . "'>(alteração)</a>";
        echo "<a href='bancodedados_senha.php?id=". $registro->id . "'>(alteração de senha)</a>";
        echo "<td>";
        echo "</tr>";
    }
}
else{
    echo "Falha na seleção de usuários <br>";
}


?>
    </table>
    <br>
    <a href="bancodedados01.php">Criar novo registro</a>
</body>
</html>