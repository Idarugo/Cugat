<?php
class Rol
{

    private $id;
    private $rol;

    function __construct($id, $rol)
    {
        $this->id = $id;
        $this->rol = $rol;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getRol(): string
    {
        return $this->rol;
    }
}
