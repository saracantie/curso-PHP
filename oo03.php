<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstração e Interfaces</title>
</head>
<body>

<?php

    abstract class InstrumentoMusical{
        public $volume;
        public abstract function tocar(); //n tem corpo pq cada subclasse vai definir a sua
    }

    interface Transportavel{
        public function transportar();
    }

    class Guitarra extends InstrumentoMusical implements Transportavel{
        public function tocar(){
            echo "Tocando guitarra <br>";
            //como instrumento é abstrato é obrigatorio que guitarra, que o extende, implemente o metodo tocar()
        }
        public function transportar(){
            echo "Transporte de guitarra: entrar em contato com a loja de música.<br>";
        }
    }

    class Computador implements Transportavel{
        public function transportar(){
            echo "Transporte de computador: chame a softblue.<br>";
        }
    }

        $guitarra = new Guitarra(); 
        $guitarra->tocar();
        $guitarra->transportar();

        $computador = new Computador();
        $computador->transportar();
        


?>
</body>
</html>