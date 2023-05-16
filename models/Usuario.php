<?php
class Usuario
{
    private  $id;
    private  $usuario;
    private  $password;
    private  $estado;


    function __construct($id, $usuario, $password, $estado)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->estado = $estado;
    }

    public function getId(): int
    {
        return $this->id;
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
