<?php

namespace App\Model;

use InvalidArgumentException;

class Matriz
{
    private array $dados;
    private int $linhas;
    private int $colunas;

    public function __construct(array $dados)
    {
        if (empty($dados) || !is_array($dados[0])) {
            throw new InvalidArgumentException("A matriz deve ser um array bidimensional não vazio.");
        }

        $this->linhas = count($dados);
        $this->colunas = count($dados[0]);

        foreach ($dados as $linha) {
            if (count($linha) !== $this->colunas) {
                throw new InvalidArgumentException("Todas as linhas da matriz devem ter o mesmo tamanho.");
            }
        }

        $this->dados = $dados;
    }

    public function getDados(): array
    {
        return $this->dados;
    }

    public function getLinhas(): int
    {
        return $this->linhas;
    }

    public function getColunas(): int
    {
        return $this->colunas;
    }

    public function somar(Matriz $outra): Matriz
    {
        if ($this->linhas !== $outra->getLinhas() || $this->colunas !== $outra->getColunas()) {
            throw new InvalidArgumentException("Dimensões incompatíveis para soma de matrizes.");
        }

        $resultado = [];
        $outrosDados = $outra->getDados();

        for ($i = 0; $i < $this->linhas; $i++) {
            for ($j = 0; $j < $this->colunas; $j++) {
                $resultado[$i][$j] = $this->dados[$i][$j] + $outrosDados[$i][$j];
            }
        }

        return new Matriz($resultado);
    }

    public function multiplicar(Matriz $outra): Matriz
    {
        if ($this->colunas !== $outra->getLinhas()) {
            throw new InvalidArgumentException("Dimensões incompatíveis para multiplicação de matrizes.");
        }

        $resultado = [];
        $outrosDados = $outra->getDados();

        for ($i = 0; $i < $this->linhas; $i++) {
            for ($j = 0; $j < $outra->getColunas(); $j++) {
                $soma = 0;
                for ($k = 0; $k < $this->colunas; $k++) {
                    $soma += $this->dados[$i][$k] * $outrosDados[$k][$j];
                }
                $resultado[$i][$j] = $soma;
            }
        }

        return new Matriz($resultado);
    }

    public function determinante(): float
    {
        if ($this->linhas !== $this->colunas) {
            throw new InvalidArgumentException("Determinante só pode ser calculado para matrizes quadradas.");
        }

        return $this->calcularDeterminanteRec($this->dados);
    }

    private function calcularDeterminanteRec(array $m): float
    {
        $n = count($m);
        if ($n === 1) {
            return (float) $m[0][0];
        }

        if ($n === 2) {
            return (float) ($m[0][0] * $m[1][1] - $m[0][1] * $m[1][0]);
        }

        $det = 0.0;
        for ($j = 0; $j < $n; $j++) {
            $submatriz = [];
            for ($i = 1; $i < $n; $i++) {
                $linha = [];
                for ($k = 0; $k < $n; $k++) {
                    if ($k !== $j) {
                        $linha[] = $m[$i][$k];
                    }
                }
                $submatriz[] = $linha;
            }
            $cofator = (($j % 2 === 0) ? 1 : -1) * $m[0][$j];
            $det += $cofator * $this->calcularDeterminanteRec($submatriz);
        }

        return $det;
    }
}