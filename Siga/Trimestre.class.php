<?php
// defini a classe Trimestre
class Trimestre{
    // Atributos da classe - o que a classe sabe
    var $codigo;
    var $descricao;

    // Métodos da classe - comportamento da classe - o que a classe faz
    function calcularMedia($notas):float{
        $sum = 0;
        foreach($notas as $nota){
            $sum += $nota;
        }
        return $sum/count($notas);
    }
}

?>