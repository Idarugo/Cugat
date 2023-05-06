<?php
class MaestroProductosFijo
{
    private  $local;
    private  $codigobarra;
    private  $descripcion;
    private  $pcosto;
    private  $pfijo;
    private  $ofertap;
    private  $ofertac;
    private  $cantidad;
    private  $desde;
    private  $hasta;
    private  $diasRestantes;
    private  $codigounion;




    function __construct($local, $codigobarra, $descripcion, $pcosto, $pfijo, $ofertap, $ofertac, $cantidad, $desde, $hasta, $diasRestantes, $codigounion)
    {
        $this->local = $local;
        $this->codigobarra = $codigobarra;
        $this->descripcion = $descripcion;
        $this->pcosto = $pcosto;
        $this->pfijo = $pfijo;
        $this->ofertap = $ofertap;
        $this->ofertac = $ofertac;
        $this->cantidad = $cantidad;
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->diasRestantes = $diasRestantes;
        $this->codigounion = $codigounion;
    }

    public function getLocal()
    {
        return $this->local;
    }
    public function getCodigobarra(): int
    {
        return $this->codigobarra;
    }
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
    public function getPcosto(): string
    {
        return $this->pcosto;
    }
    public function getPfijo(): string
    {
        return $this->pfijo;
    }
    public function getOfertap(): string
    {
        return $this->ofertap;
    }
    public function getPrecioC(): string
    {
        return $this->pcosto;
    }
    public function getOfertac(): string
    {
        return $this->ofertac;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function getDesde()
    {
        return $this->desde;
    }
    public function getHasta()
    {
        return $this->hasta;
    }
    public function getDiasRestantes(): string
    {
        return $this->diasRestantes;
    }
    public function getCodigounion(): string
    {
        return $this->codigounion;
    }
}
