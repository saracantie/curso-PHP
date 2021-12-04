<html>
    <head>
        <title>Arrays e Funções Especiais</title>
    </head>
    <body>
        <?php
            $arrayExemplo = array(0 => "Php", 1 => "SQL", 5 => 100, "Curso" => "Java");
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    echo "Posição 0: " . $arrayExemplo[0] . "<BR>";
    echo "Posição 1: " . $arrayExemplo[1] . "<BR>";
    echo "Posição 5: " . $arrayExemplo[5] . "<BR>";
    echo "Posição 'Curso': " . $arrayExemplo['Curso'] . "<BR><BR>";
    
    unset($arrayExemplo["Curso"]);
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    echo count($arrayExemplo) . "<BR><BR>";
    echo sizeof($arrayExemplo) . "<BR><BR>";
    
    foreach($arrayExemplo as $elemento)
    {
        echo "Tem no array: " . $elemento . ", ";
    }
    echo "<BR><BR>";
    
    array_push($arrayExemplo, "André");
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    $x = array_pop($arrayExemplo);
    echo $x . "<BR>";
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    $x = array_shift($arrayExemplo);
    echo $x . "<BR>";
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    array_unshift($arrayExemplo, "Milani");
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    $arrayExemplo = array(140.1, 200, 215.05, 550);
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    function insereMoeda($valor)
    {
        $valor = "R$ " . $valor;
        return $valor;
    }
    
    $arrayExemplo = array_map("insereMoeda", $arrayExemplo);
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    $arrayExemplo = array("Linguagem1" => "Php",
                          "Linguagem2" => "SQL",
                          "Linguagem3" => 100,
                          "Linguagem4" => "Java");
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    if(array_key_exists("Linguagem2", $arrayExemplo))
    {
        echo "Existe 'Linguagem2' no array <BR><BR>";
    }
    else
    {
        echo "Não existe 'Linguagem2' no array <BR><BR>";
    }
    
    if(array_key_exists("Linguagem70", $arrayExemplo))
    {
        echo "Existe 'Linguagem70' no array <BR><BR>";
    }
    else
    {
        echo "Não existe 'Linguagem70' no array <BR><BR>";
    }
    
    $keys = array_keys($arrayExemplo);
    foreach($keys as $key)
    {
        echo $key . ", ";
    }
    echo "<BR><BR>";
    
    $key = array_search("Php", $arrayExemplo);
    echo "Chave do elemento 'Php' é: " . $key;
    echo "<BR><BR>";
    
    $isIn = in_array("C++", $arrayExemplo);
    if($isIn)
    {
        echo "Elemento existe no array!";
    }
    else
    {
        echo "Elemento não existe no array!";
    }
    echo "<BR><BR>";
    
    print_r($arrayExemplo);
    echo "<BR>";
    
    shuffle($arrayExemplo);
    print_r($arrayExemplo);
    echo "<BR>";
    
    sort($arrayExemplo);
    print_r($arrayExemplo);
    echo "<BR>";
    
    rsort($arrayExemplo);
    print_r($arrayExemplo);
    echo "<BR>";
    
    $stringExemplo = "10;20;30;40;50";
    $arrayExemplo = explode(";", $stringExemplo);
    print_r($arrayExemplo);
    echo "<BR><BR>";
    
    $arrayExemplo = array("a", "b", "c", "d", "e");
    $stringExemplo = implode(";", $arrayExemplo);
    echo $stringExemplo;
    echo "<BR><BR>";
    
    $stringExemplo = "chave=valor&chave2=valor2&var1=Php"; //separa as strings
    parse_str($stringExemplo, $arrayExemplo);
    print_r($arrayExemplo);
        
        ?>
    </body>
</html>