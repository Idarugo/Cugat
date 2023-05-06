<?php
class Locales
{
    private  $id;
    private  $nombre;
    private  $server;
    private  $usuario;
    private  $pass;


    function __construct($id, $nombre, $server, $usuario, $pass)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->server = $server;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getServer(): string
    {
        return $this->server;
    }
    public function getUsuario(): string
    {
        return $this->usuario;
    }
    public function getPass(): string
    {
        return $this->pass;
    }
}
