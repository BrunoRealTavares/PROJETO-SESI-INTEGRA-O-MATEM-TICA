# PROJETO SESI | INTEGRAÇÃO MATEMÁTICA
> **Laboratório Digital de Álgebra Linear & Sistemas Lineares**
> Aplicação Web desenvolvida para simulação de operações matriciais e resolução de sistemas lineares utilizando a Regra de Cramer.

---

## Desenvolvedores & Contribuições

* **Bruno Tavares** (`bruno.tavares@ba.estudante.senai.br`)
  * Estrutura base da arquitetura MVC.
  * Modelos de negócio (`Model/Matriz.php` e `Model/SistemaLinear.php`).
  * Tratamento de exceções algébricas (dimensões incompatíveis e determinante nulo).

* **Pedro Lucas** (`pedrolucaspaz359@gmail.com`)
  * Controladores e rotas da aplicação (`Controller/MatrizController.php`).
  * Interface visual responsiva em Bootstrap 5 (`view/home.php`).
  * Suíte de testes unitários automatizados com PHPUnit (`tests/`).

---

## Tecnologias Utilizadas

* **Linguagem:** PHP 8.4
* **Arquitetura:** MVC (Model-View-Controller)
* **Gerenciador de Dependências:** Composer (Autoload PSR-4)
* **Testes Automatizados:** PHPUnit 11
* **Interface Gráfica:** Bootstrap 5
* **Ambiente Servidor:** XAMPP (Apache) / Windows

---

## Funcionalidades

1. **Soma de Matrizes ($A + B$):** Valida dimensões e realiza a soma elemento a elemento.
2. **Multiplicação de Matrizes ($A \times B$):** Executa a multiplicação matricial respeitando a condição de compatibilidade de colunas e linhas.
3. **Cálculo de Determinante ($\det(A)$):** Algoritmo para cálculo de determinantes em matrizes quadradas.
4. **Resolução de Sistemas Lineares (Regra de Cramer):** Resolve sistemas da forma $Ax = B$, lançando exceção caso o sistema seja singular ($\det(A) = 0$).



