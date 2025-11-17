<?php

abstract class Conta
{
    protected $numero;
    protected $titular;
    protected $saldo;

    public function __construct($numero, Titular $titular)
    {
        $this->setNumero($numero);
        $this->setTitular($titular);
        $this->saldo = 0;
    }

    public function setNumero($numero)
    {
        if ($numero <= 0) {
            throw new InvalidArgumentException("O número da conta deve ser positivo.");
        }
        $this->numero = $numero;
    }

    public function setTitular(Titular $titular)
    {
        if ($titular === null) {
            throw new InvalidArgumentException("O titular da conta não pode ser nulo.");
        }
        $this->titular = $titular;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getTitular()
    {
        return $this->titular;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    abstract public function Depositar($valor);
    abstract public function Sacar($valor);

    public function __toString()
    {
        return "Conta Número: {$this->numero}, Titular: {$this->titular->getNome()}, Saldo: {$this->formatarValor($this->saldo)}";
    }

    public function Transferir(Conta $contaDestino, $valor)
    {
        if ($contaDestino === null) {
            throw new InvalidArgumentException("A conta de destino não pode ser nula.");
        }

        $this->Sacar($valor);
        $contaDestino->Depositar($valor);
    }

    private function formatarValor($valor)
    {
        return number_format($valor, 2, ',', '.'); // Formata o valor para REAL
    }
}

class Titular
{
    private $nome;

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }
}

?>
