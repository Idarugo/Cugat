<?php
class MaestroProductos_Precio
{
    private  $local;
    private  $codigo;
    private  $preciopuntoventa;


    function __construct(
        $local,
        $codigo,
        $preciopuntoventa
    ) {
        $this->local = $local;
        $this->codigo = $codigo;
        $this->preciopuntoventa = $preciopuntoventa;
    }

    public function getLocal(): int
    {
        return $this->local;
    }
    public function getCodigo(): int
    {
        return $this->codigo;
    }
    public function getPreciopuntoventa(): int
    {
        return $this->preciopuntoventa;
    }
}
