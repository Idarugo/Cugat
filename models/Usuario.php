<?php
class Usuario
{
    private  $rut;
    private  $nombre;
    private  $labor;
    private  $correo;
    private  $usuario;
    private  $password;
    private  $estado;


    function __construct($rut, $nombre, $labor, $correo, $usuario, $password, $estado)
    {
        $this->rut = $rut;
        $this->nombre = $nombre;
        $this->labor = $labor;
        $this->correo = $correo;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->estado = $estado;
    }

    public function getRut(): string
    {
        return $this->rut;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getLabor(): string
    {
        return $this->labor;
    }
    public function getCorreo(): string
    {
        return $this->correo;
    }
    public function getUsuario(): string
    {
        return $this->usuario;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getEstado(): int
    {
        return $this->estado;
    }
}
