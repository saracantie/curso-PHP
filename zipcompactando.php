<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zip: Compactando</title>
</head>
<body>

<?php

    $meuZip = new ZipArchive();
    $filename = "ziparquivo.zip";

    if ($meuZip->open($filename, ZipArchive::CREATE) !== true){
        echo "Falha na abertura e/ou criação do arquivo " . $filename;
    }
    else{
        //compactando um arquivo
        $meuZip->addFile("ziparquivo.txt");
        //criar um arquivo diretamente dentro do zip
        $meuZip->addFromString("teste.txt", "Conteúdo de teste.txt");
        $meuZip->addEmptyDir("Diretorio");
        $meuZip->addFromString("Diretorio/teste2.txt", "Conteúdo 2");

        $meuZip->close();

        echo"Arquivo Zip gerado com sucesso";

    }

  ?>  
</body>
</html>