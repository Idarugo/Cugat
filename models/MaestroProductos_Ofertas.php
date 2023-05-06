<?php
class MaestroProductos_Ofertas
{
    private  $local;
    private  $codigo;
    private  $codigoprecio;


    function __construct(
        $local,
        $codigo,
        $codigoprecio

    ) {
        $this->local = $local;
        $this->codigo = $codigo;
        $this->codigoprecio = $codigoprecio;
    }

    public function getLocal(): int
    {
        return $this->local;
    }
    public function getCodigo(): int
    {
        return $this->codigo;
    }
    public function getCodigoprecio(): int
    {
        return $this->codigoprecio;
    }
}
