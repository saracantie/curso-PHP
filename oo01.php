<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes e Objetos</title>
</head>
<body>
    
<?php

    class Carro{
        //atributos da classe SEMPRE private com get e set
        private $velocidade;
        private $cor;

        //construtor é smpr publico
        public function __construct($cor){
            $this->setCor($cor);
            $this->setVelocidade(0);
        }

        public function getVelocidade(){
            return $this->velocidade;
        }

        public function getCor(){
            return $this->cor;
        }

        private function setVelocidade($velocidade){
            if($velocidade > 110 || $velocidade < 0){
                echo "Velocidade não permitida.<br>";
            }
            else{
                $this->velocidade = $velocidade;
            }
        }

        public function setCor($cor){
            $this->cor = $cor;
        }

        public function acelerar(){
            $this->setVelocidade($this->getVelocidade() + 1);
        }

        public function frear(){
            $this->setVelocidade($this->getVelocidade() - 1);
        }
    }

    //$meuCarro = new Carro();
    //$meuCarro->velocidade = 50;
    //$meuCarro->cor = "Preta";
    //echo "Ocarro de cor " . $meuCarro->cor . " está andando: " . $meuCarro->velocidade;
    //echo "<br>";

    $meuCarro = new Carro("Vermelha");
    $meuCarro->acelerar();
    $meuCarro->acelerar();
    $meuCarro->acelerar();
    $meuCarro->acelerar();
    $meuCarro->acelerar();
    $meuCarro->frear();
    echo "O carro de cor " . $meuCarro->getCor() . " está andando: " . $meuCarro->getVelocidade();
    echo "<br>";

    //$meuCarro->setVelocidade(70);
    //echo "Ocarro de cor " . $meuCarro->getCor() . " está andando: " . $meuCarro->getVelocidade();
    //echo "<br>";

    //$meuCarro->setVelocidade(-220);
    //echo "Ocarro de cor " . $meuCarro->getCor() . " está andando: " . $meuCarro->getVelocidade();
    //echo "<br>";


    //$meuCarro->cor = "Amarela";
    //$meuCarro->velocidade = 220;

    //echo "Ocarro de cor " . $meuCarro->cor . " está andando: " . $meuCarro->velocidade;
    //echo "<br>";

?>



</body>
</html>