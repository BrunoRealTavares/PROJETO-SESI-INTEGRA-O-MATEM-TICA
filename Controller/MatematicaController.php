<?php

namespace App\Controller;

use App\Model\Matriz;
use App\Model\SistemaLinear;
use Exception;

class MatematicaController
{
    public function processar(): array
    {
        $resultado = null;
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $operacao = $_POST['operacao'] ?? '';

            try {
                if ($operacao === 'somar') {
                    $m1 = new Matriz($this->converterStringParaMatriz($_POST['matriz1'] ?? ''));
                    $m2 = new Matriz($this->converterStringParaMatriz($_POST['matriz2'] ?? ''));
                    $resMatriz = $m1->somar($m2);
                    $resultado = [
                        'tipo' => 'matriz',
                        'titulo' => 'Resultado da Soma (A + B)',
                        'dados' => $resMatriz->getDados()
                    ];
                } elseif ($operacao === 'multiplicar') {
                    $m1 = new Matriz($this->converterStringParaMatriz($_POST['matriz1'] ?? ''));
                    $m2 = new Matriz($this->converterStringParaMatriz($_POST['matriz2'] ?? ''));
                    $resMatriz = $m1->multiplicar($m2);
                    $resultado = [
                        'tipo' => 'matriz',
                        'titulo' => 'Resultado da Multiplicação (A × B)',
                        'dados' => $resMatriz->getDados()
                    ];
                } elseif ($operacao === 'determinante') {
                    $m1 = new Matriz($this->converterStringParaMatriz($_POST['matriz1'] ?? ''));
                    $det = $m1->determinante();
                    $resultado = [
                        'tipo' => 'valor',
                        'titulo' => 'Determinante det(A)',
                        'valor' => $det
                    ];
                } elseif ($operacao === 'cramer') {
                    $A = new Matriz($this->converterStringParaMatriz($_POST['matriz1'] ?? ''));
                    $B = array_map('floatval', explode(',', $_POST['vetor_b'] ?? ''));
                    $solucao = SistemaLinear::resolverCramer($A, $B);
                    $resultado = [
                        'tipo' => 'vetor',
                        'titulo' => 'Solução do Sistema Linear (Ax = B)',
                        'dados' => $solucao
                    ];
                }
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }

        return ['resultado' => $resultado, 'erro' => $erro];
    }

    private function converterStringParaMatriz(string $input): array
    {
        $linhas = explode("\n", trim($input));
        $matriz = [];
        foreach ($linhas as $linha) {
            $linha = trim($linha);
            if (!empty($linha)) {
                $elementos = array_map('floatval', preg_split('/\s+|,/', $linha));
                $matriz[] = $elementos;
            }
        }
        return $matriz;
    }
}