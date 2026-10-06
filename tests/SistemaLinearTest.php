<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Matriz;
use App\Model\SistemaLinear;
use InvalidArgumentException;

class SistemaLinearTest extends TestCase
{
    public function testSistemaLinearCasoFeliz(): void
    {
        // 2x + y = 5
        // x - y = 1  => x = 2, y = 1
        $A = new Matriz([[2, 1], [1, -1]]);
        $B = [5, 1];

        $solucao = SistemaLinear::resolverCramer($A, $B);

        $this->assertEqualsWithDelta(2.0, $solucao[0], 0.0001);
        $this->assertEqualsWithDelta(1.0, $solucao[1], 0.0001);
    }

    public function testSistemaSingularExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        // Coeficientes proporcionais (det = 0)
        $A = new Matriz([[1, 2], [2, 4]]);
        $B = [3, 6];

        SistemaLinear::resolverCramer($A, $B);
    }
}