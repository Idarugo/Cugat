<?php
class MaestroProductos
{
    private  $codigo;
    private  $cantidad;
    private  $precio;
    private  $precioC;
    private  $desde;
    private  $hasta;
    private  $codigounion;
    private  $local;
    private  $usuariocreacion;
    private  $fechacreacion;



    function __construct($codigo, $cantidad, $precio, $precioC, $desde, $hasta, $codigounion, $local, $usuariocreacion, $fechacreacion)
    {
        $this->codigo = $codigo;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->precioC = $precioC;
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->codigounion = $codigounion;
        $this->local = $local;
        $this->usuariocreacion = $usuariocreacion;
        $this->fechacreacion = $fechacreacion;
    }

    public function getCodigo(): int
    {
        return $this->codigo;
    }
    public function getCantidad(): int
    {
        return $this->cantidad;
    }
    public function getPrecio(): int
    {
        return $this->precio;
    }
    public function getPrecioC(): int
    {
        return $this->precioC;
    }
    public function getDesde(): int
    {
        return $this->desde;
    }
    public function getHasta(): int
    {
        return $this->hasta;
    }
    public function getCodigounion(): int
    {
        return $this->codigounion;
    }
    public function getLocal(): int
    {
        return $this->local;
    }
    public function getUsuariocreacion(): int
    {
        return $this->usuariocreacion;
    }
    public function getFechacreacion(): int
    {
        return $this->fechacreacion;
    }
}
