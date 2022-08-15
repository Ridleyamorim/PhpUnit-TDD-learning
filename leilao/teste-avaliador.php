<?php

require 'vendor/autoload.php';

use Ridley\Leilao\Model\Lance;
use Ridley\Leilao\Model\Leilao;
use Ridley\Leilao\Model\Usuario;
use Ridley\Leilao\Service\Avaliador;
//Arrange - avalia/prepara cenário
$leilao = new Leilao('Fiat 147 0Km');

$maria = new Usuario('Maria');
$joao = new Usuario(('João'));

$leilao->recebeLance(new Lance($joao, 2000));
$leilao->recebeLance(new Lance($maria, 2500));

$leiloeiro = new Avaliador();

//Act - executa o código a ser testado
$leiloeiro->avaliar($leilao);

//Assert - verifica se a saída é a esperada
$maiorValor = $leiloeiro->getMaiorValor();

echo $maiorValor;