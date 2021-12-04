<html>
    <head>
        <title>PHP</title>
    </head>
    <body>
        
<?php
        
    echo "Hello World<br>";
    
    //include("softblue01_auxiliar.php");
    //include("softblue01_auxiliar.php"); - chamada dupla
    include_once("softblue01_auxiliar.php"); //se vc chama duas vezes ele não chama
    
    require("softblue01_auxiliar.php"); //se o arquivo nao existir o programa para e nao segue os proximos codigos
    
    //header("Location: http://google.com"); //encaminha o susario pra uma pagina
    
    echo "Finalizando... <br>";
    
    
    function funcaoDobro($valor):int{
        $valor *= 2;
        return $valor;
    }
    
    $x = funcaoDobro(5);
    echo $x."<br>";
    
    //operador spaceship <=>
    
    $x = "b" <=> "a";
    echo $x . "<br";
    // -1 se o primeiro (b) é menor/anterior que o outro
    //0 se iguais
    // 1 se maior/posterior
    
    
    //operador ??
    $x = null;
    //em vez de fazer um isset vc faz em uma linha assim:
    $y = $x ?? "valor alternativo"; //se x for nulo, como é o caso, y recebe um valor alternativo. se nao for nulo y recebe x
    
?>
        
      
    </body>
         
</html>