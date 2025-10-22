<?php

require_once 'Titular.php';


abstract class Conta{

    protected $id;

    protected $titular;

    protected float $saldo;

    protected float $limite;

    public function setNUmero(int $id)
    {
        if($numero <= 0)
        {
            throw new Exception("Número da conta deve ser positivo");
        }
        $this->id = $id;
        
    }
    public function getId(): int
    {
        return $this->id;
    }

}