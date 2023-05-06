<?php
require __DIR__ . '../../models/Conexion.php';


class ConexionController
{
    private $connectDB2;

    function __construct($connectDB2)
    {
        $this->connectDB2 = $connectDB2;
    }

    // public function listLocales()
    // {
    //     $local = array();
    //     $this->connectDB1->connect();
    //     $sql = " SELECT * FROM `locales`";
    //     $st = $this->connectDB1->query($sql);
    //     while ($rs = mysqli_fetch_array($st)) {
    //         $local[] = new Locales($rs['id'], $rs['nombre'],  $rs['server'],  $rs['usuario'],  $rs['pass']);;
    //     }
    //     $this->connectDB1->disconnect();
    //     return $local;
    // }
}
