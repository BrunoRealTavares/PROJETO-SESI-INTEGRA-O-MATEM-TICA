<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Matriz;
use InvalidArgumentException;

class MatrizTest extends TestCase
{
    public function testSomaCasoFeliz(): void
    {
        $m1 = new Matriz([[1, 2], [3, 4]]);
        $m2 = new Matriz([[5, 6], [7, 8]]);
        $resultado = $m1->somar($m2);

        $this->assertEquals([[6, 8], [10, 12]], $resultado->getDados());
    }

    public function testMultiplicacaoCasoFeliz(): void
    {
        $m1 = new Matriz([[1, 2], [3, 4]]);
        $m2 = new Matriz([[2, 0], [1, 2]]);
        $resultado = $m1->multiplicar($m2);

        $this->assertEquals([[4, 4], [10, 8]], $resultado->getDados());
    }

    public function testDeterminante1x1Borda(): void
    {
        $m = new Matriz([[7]]);
        $this->assertEqualsWithDelta(7.0, $m->determinante(), 0.0001);
    }

    public function testDeterminanteIdentidade(): void
    {
        $m = new Matriz([[1, 0], [0, 1]]);
        $this->assertEqualsWithDelta(1.0, $m->determinante(), 0.0001);
    }

    public function testDimensoesIncompativeisSomaExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $m1 = new Matriz([[1, 2]]);
        $m2 = new Matriz([[1], [2]]);
        $m1->somar($m2);
    }
}