<?php

require_once 'Titular.php';

abstract class Conta{

    protected int $id;
    protected Titular $titular;
    protected float $saldo;
    protected float $limite;


    public function setId(int $id): void
    {
        if ($id <= 0)
        {
            throw new Exception("O número da conta deve ser positivo.");
        }
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitular(Titular $titular): void
    {        
        $this->titular = $titular;
    }

    public function getTitular(): Titular
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function setLimite(float $limite): void
    {
        if ($limite < 0)
        {
            throw new Exception("O limite não pode ser negativo.");
        }
        $this->limite = $limite;
    }
    public function getLimite(): float
    {
        return $this->limite;
    }

    abstract public  function Depositar(float $valor): void;
    abstract public function Sacar(float $valor): void;

    public function __toString(): string
    {
        return "Conta Número: {$this->id}, Titular: {$this->titular->getNome()}, Saldo: {$this->saldo->getSaldo()}, Limite: {$this->limite->getLimite()}";
    }

    public function Transferir(Conta $contaDestino, float $valor): void
    {
        if ($contaDestino == $this) {
            throw new Exception("Não é possível transferir para a mesma conta.");
        }
        $this->Sacar(valor: $valor);
        $contaDestino->Depositar(valor: $valor);
    }







}