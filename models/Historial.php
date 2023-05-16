<?php

class Historial
{
    private $id;
    private $codigo_producto;
    private $precio_antiguo;
    private $precio_nuevo;
    private $fecha_creacion;
    private $fecha_expiracion;
    private $estado;


    function __construct($id, $codigo_producto, $precio_antiguo, $precio_nuevo, $fecha_creacion, $fecha_expiracion, $estado)
    {
        $this->id = $id;
        $this->codigo_producto = $codigo_producto;
        $this->precio_antiguo = $precio_antiguo;
        $this->precio_nuevo = $precio_nuevo;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_expiracion = $fecha_expiracion;
        $this->estado = $estado;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of codigo_producto
     */
    public function getCodigo_producto()
    {
        return $this->codigo_producto;
    }

    /**
     * Get the value of precio_antiguo
     */
    public function getPrecio_antiguo()
    {
        return $this->precio_antiguo;
    }

    /**
     * Get the value of precio_nuevo
     */
    public function getPrecio_nuevo()
    {
        return $this->precio_nuevo;
    }

    /**
     * Get the value of fecha_creacion
     */
    public function getFecha_creacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Get the value of fecha_expiracion
     */
    public function getFecha_expiracion()
    {
        return $this->fecha_expiracion;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
