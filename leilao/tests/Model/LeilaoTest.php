<?php

namespace Ridley\Leilao\Tests\Model;

use PHPUnit\Framework\TestCase;
use Ridley\Leilao\Model\Lance;
use Ridley\Leilao\Model\Leilao;
use Ridley\Leilao\Model\Usuario;

class LeilaoTest extends TestCase
{
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
}