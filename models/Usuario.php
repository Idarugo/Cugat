<?php
class Usuario
{
    private  $rut;
    private  $nombre;
    private  $labor;
    private  $correo;
    private  $user;
    private  $password;
    private  $rol;
    private  $admin;
    private  $estado;


    function __construct($rut, $nombre, $labor, $correo, $user, $password, $rol, $admin, $estado)
    {
        $this->rut = $rut;
        $this->nombre = $nombre;
        $this->labor = $labor;
        $this->correo = $correo;
        $this->user = $user;
        $this->password = $password;
        $this->rol = $rol;
        $this->admin = $admin;
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
        return $this->user;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getAdmin(): int
    {
        return $this->admin;
    }
    public function getEstado(): int
    {
        return $this->estado;
    }
}
