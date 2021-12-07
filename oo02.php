<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herança e Elementos Estáticos</title>
</head>
<body>
    
<?php
//sem usar getter e setters pra nao ficar mt poluido, pra ser didatico:

    class InstrumentoMusical{
        public $isPercussao;
        public $volume;

        public function __construct($isPercussao, $volume){
            $this->isPercussao = $isPercussao;
            $this->volume = $volume;
        }
        //o final impede que o metodo seja sobrescrito nas filhas -> public final function
        public function tocar(){
            echo "Tocando no volume: " .$this->volume . " decibéis.<br>";
        }
    }

    class Guitarra extends InstrumentoMusical{
        public function tocar(){
            echo "Amplificador ligado em " . $this->volume . " decibéis.<br>";
        }

        public function tocarGuitarra(){
            $this->tocar();
            parent::tocar();
        }
    }


    $instrumentoMusical = new InstrumentoMusical(true, 80);

    if($instrumentoMusical->isPercussao){
        echo"Instrumento de percussão. volume: " . $instrumentoMusical->volume . "<br>";
    }
    else{
        echo"Instrumento não de percussão. volume: " . $instrumentoMusical->volume . "<br>";
    }
    $instrumentoMusical->tocar();

    $guitarra = new Guitarra(false, 40);

    if($guitarra->isPercussao){
        echo"Instrumento de percussão. volume: " . $guitarra->volume . "<br>";
    }
    else{
        echo"Instrumento não de percussão. volume: " . $guitarra->volume . "<br>";
    }
    $guitarra->tocar();
    echo "<br><br>";
    
    $guitarra->tocarGuitarra();
    echo "<br><br>";

    class EscalaMusical{
        //esse elemento abaixo não vai mudar de objeto pra objeto, vai ser sempre igual. entao pra n usar memoria a toa sempre transforme elementos assim em estáticos
        
        public static $escalaDoMaior = "C D E F G A B C";

        public static function calculaDecibeis($watts){
            return $watts / 10;
        }
    }
    //se nao fosse static daria erro
    echo EscalaMusical::$escalaDoMaior . "<br>";
    echo EscalaMusical::calculadecibeis(123)  . "<br>";




?>
</body>
</html>