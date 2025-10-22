<?php

require_once 'Conta.php';

class Contacorrente extends Conta{

    #[Override]
    public function Depositar(float $valor): array
    {
        if ($valor <= 0)
        {
            throw new Exception("O valor do depósito deve ser positivo.");
        }
        $this->saldo += $valor * 0.99; // Taxa de 1% para conta corrente

        return [
            "tipo"=> "depósito",
            "valor_depositado" => $valor,
            "saldo_atual" => $this->saldo,
            "taxa" => $valor * 0.01
        ];
    }

    #[Override]
    public function Sacar(float $valor): array
    {
        $valorcomtaxa = $valor * 1.01; // Taxa de 1% para saque em conta corrente
        if ($valor <= 0)
        {
            throw new Exception("O valor do saque deve ser positivo.");
        }
        if ($valorcomtaxa > $this->saldo)
        {
            throw new Exception("Saldo insuficiente para o saque.");
        }
        $this->saldo -= $valorcomtaxa;

        return [
            "tipo"=> "saque",   
            "valor_sacado" => $valor,
            "saldo_atual" => $this->saldo,
            "taxa" => $valor * 0.01
        ];
    }

    
}