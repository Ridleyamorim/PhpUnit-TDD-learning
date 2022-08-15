<?php

namespace Ridley\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Ridley\Leilao\Model\Lance;
use Ridley\Leilao\Model\Leilao;
use Ridley\Leilao\Model\Usuario;
use Ridley\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    private $leiloeiro; 

    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    public function testAvaliadorEncontrarOMaiorValor ()
    {
        //Arrange - avalia/prepara cenário
        $leilao = $this->leilaoEmOrdemCrescente();

        //Act - executa o código a ser testado
        $this->leiloeiro->avaliar($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        //Assert - verifica se a saída é a esperada
        self::assertEquals(3500, $maiorValor); 
    }
  
    public function testAvaliadorEncontrarOMenorValor ()
    {
        //Arrange - avalia/prepara cenário
        $leilao = $this->leilaoEmOrdemDecrescente();

        //Act - executa o código a ser testado
        $this->leiloeiro->avaliar($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        //Assert - verifica se a saída é a esperada
        self::assertEquals(1200, $menorValor); 
    }

    public function testAvaliadorEncontrarOs3MaioresValores ()
    {
        //Arrange - avalia/prepara cenário
        $leilao = $this->leilaoEmOrdemAleatoria();

        //Act - executa o código a ser testado
        $this->leiloeiro->avaliar($leilao);

        $maioresLances = $this->leiloeiro->getMaioresLances();

        //Assert - verifica se a saída é a esperada
        self::assertCount(3, $maioresLances); 
        self::assertEquals(3100, $maioresLances[0]->getValor());
        self::assertEquals(2500, $maioresLances[1]->getValor());
        self::assertEquals(2000, $maioresLances[2]->getValor());
    }

    /*-------------- DADOS ----------------*/ 
    public function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Fiat 147 0Km');

        $maria = new Usuario('Maria');
        $joao = new Usuario(('João'));
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($ana, 3500));

        return $leilao;

    }
    
    public function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Fiat 147 0Km');

        $maria = new Usuario('Maria');
        $joao = new Usuario(('João'));
        $marcos = new Usuario('Marcos');

        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($marcos, 1200));

        return $leilao;
    }

    public function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 147 0Km');

        $maria = new Usuario('Maria');
        $joao = new Usuario(('João'));
        $luana = new Usuario('Luana');
        $luiza = new Usuario('Luiza');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($luana, 3100));
        $leilao->recebeLance(new Lance($luiza, 1200));

        return $leilao;
    }
}