<HTML>
    <HEAD>
        <TITLE>Manipulação de Arquivos</TITLE>
    </HEAD>
    <BODY>
        
<?php

    $filepath = "C:/Temp/teste.txt";
    
    /*
    if(is_file($filepath))
    {
        echo "O arquivo existe!<BR>";
    }
    else
    {
        echo "O arquivo não existe!<BR>";
    }
    
    $meuArquivo = fopen($filepath, "a+");  //a+ para criar o arquivo se n existir
    fwrite($meuArquivo, "Softblue");
    fwrite($meuArquivo, " - Cursos online");
    fwrite($meuArquivo, "\r\n"); //representam quebra de linha
    fclose($meuArquivo);
    
    if(is_file($filepath))
    {
        echo "O arquivo existe!<BR>";
    }
    else
    {
        echo "O arquivo não existe!<BR>";
    }
    */
    
    $meuArquivo = fopen($filepath, "r"); //r leitura do arquivo
    
    $buffer = fread($meuArquivo, 10); //le 10 bytes do arquivo aprox 10 caracteres
    echo $buffer . "<BR>";
    
    $buffer = fread($meuArquivo, 10);
    echo $buffer . "<BR>";
    
    $buffer = fread($meuArquivo, 10);
    echo $buffer . "<BR>";
    
    fclose($meuArquivo);
    
    echo "<BR><BR>";
    
    $meuArquivo = fopen($filepath, "r");
    $buffer = fread($meuArquivo, filesize($filepath));
    echo utf8_encode($buffer) . "<BR>"; //utf encode resolve o problema de nao ler acentos
    fclose($meuArquivo);
    
    echo "<BR><BR>";
    
    $meuArray = file($filepath); 
    foreach($meuArray as $elemento)
    {
        echo "Linha do arquivo: " . utf8_encode($elemento) . "<BR>";
    }
    // Quando aberto via file não há a necessidade de fclose
    
    $dir = opendir("C:/"); //abrir diretorio
    echo readdir($dir) . "<BR>"; //aponta pro primeiro arquivo 
    echo readdir($dir) . "<BR>";
    echo readdir($dir) . "<BR>";
    echo readdir($dir) . "<BR>";
    echo readdir($dir) . "<BR>";
    closedir($dir);

?>
        
    </BODY>
</HTML>