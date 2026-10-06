<?php

namespace App\Model;

use InvalidArgumentException;

class SistemaLinear
{
    /**
     * Resolve sistemas Ax = B usando a Regra de Cramer.
     */
    public static function resolverCramer(Matriz $A, array $B): array
    {
        if ($A->getLinhas() !== $A->getColunas()) {
            throw new InvalidArgumentException("A matriz de coeficientes deve ser quadrada.");
        }

        if (count($B) !== $A->getLinhas()) {
            throw new InvalidArgumentException("O vetor de termos independentes deve ter o mesmo tamanho das equações.");
        }

        $detGeral = $A->determinante();

        if (abs($detGeral) < 1e-9) {
            throw new InvalidArgumentException("Sistema Singular: determinante zero (Impossível ou Indeterminado).");
        }

        $n = $A->getLinhas();
        $solucao = [];
        $dadosA = $A->getDados();

        for ($j = 0; $j < $n; $j++) {
            $dadosSub = $dadosA;
            for ($i = 0; $i < $n; $i++) {
                $dadosSub[$i][$j] = $B[$i];
            }
            $matrizSub = new Matriz($dadosSub);
            $solucao[] = $matrizSub->determinante() / $detGeral;
        }

        return $solucao;
    }
}