<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com Umpload</title>
</head>
<body>
<?php

    if(isset($_REQUEST["envio"]) && $_REQUEST["envio"] == true){
        $erro = 0;

        if(isset($_FILES["campoArquivo"])){

            $arquivoNome = $_FILES["campoArquivo"]["name"]; //um array dentro de outro array
            $arquivoTipo = $_FILES["campoArquivo"]["type"];
            $arquivoTamanho = $_FILES["campoArquivo"]["size"];
            $arquivoNomeTemp = $_FILES["campoArquivo"]["tmp_name"];
            $erro = $_FILES["campoArquivo"]["error"]; //em caso de sucesso ele ja retorna zero por padrão

            if($erro == 0){
                if(is_uploaded_file($arquivoNomeTemp)){
                    if(move_uploaded_file($arquivoNomeTemp, "uploads/".$arquivoNome)){
                        echo "Sucesso!";
                    }
                    else{
                        $erro = "Falha ao mover o arquivo/permissão de acesso/caminho invalido";
                    }
                }
                else{
                    $erro = "Arquivo não recebido com sucesso";
                }
            }
            else{
                $erro = "Erro no envio: " . $erro;
            }

        }
        else{
            $erro = "Arquivo enviado não encontrado";
        }
    if($erro !== 0){
        echo $erro;
    }
    }

?>
    <form action="?envio=true" method="post" enctype="multipart/form-data">
        Arquivo:
        <input type="file" name="campoArquivo"><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>