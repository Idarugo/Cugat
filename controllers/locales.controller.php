<?php
require __DIR__ . '../../models/Locales.php';


class LocalesController
{
    private $connectDB1;

    function __construct($connectDB1)
    {
        $this->connectDB1 = $connectDB1;
    }

    public function listLocales()
    {
        $local = array();
        $this->connectDB1->connect();
        $sql = " SELECT * FROM `locales`";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $local[] = new Locales($rs['id'], $rs['nombre'],  $rs['server'],  $rs['usuario'],  $rs['pass']);;
        }
        $this->connectDB1->disconnect();
        return $local;
    }
}
