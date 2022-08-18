<?php

namespace Ridley\Leilao\Tests\Model;

use PHPUnit\Framework\TestCase;
use Ridley\Leilao\Model\Lance;
use Ridley\Leilao\Model\Leilao;
use Ridley\Leilao\Model\Usuario;

use function PHPUnit\Framework\assertCount;

class LeilaoTest extends TestCase
{

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new leilao('Variante');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 1500));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());


    }
    public function testLeilaoDeveReceberLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao = new Leilao('Palio 0km');
        $leilao->recebeLance(new Lance($joao, 1500));
        $leilao->recebeLance(new Lance($maria, 2500));

        static::assertCount(2, $leilao->getLances());
        static::assertEquals(1500, $leilao->getLances()[0]->getValor());
        static::assertEquals(2500, $leilao->getLances()[1]->getValor());

    }

    public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao('Renault Clio');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));
        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));

        $leilao->recebeLance(new Lance($joao, 6000));

        static::assertCount(10, $leilao->getLances());
        static::assertEquals(5500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());

    }
}