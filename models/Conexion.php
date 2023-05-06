<?php
class Conexion
{
    private $nombreBD;
    private $servidor;
    private $usuario;
    private $contraseña;


    function __construct($nombreBD, $servidor, $usuario, $contraseña)
    {
        $this->nombreBD = $nombreBD;
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
    }

    public function getNombreBD(): int
    {
        return $this->nombreBD;
    }
    public function getServidor(): string
    {
        return $this->servidor;
    }
    public function getUsuario(): string
    {
        return $this->usuario;
    }
    public function getContraseña(): string
    {
        return $this->contraseña;
    }
}
