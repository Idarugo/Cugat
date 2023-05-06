<?php
require __DIR__ . '../../database/DatabaseMYSQL.php';
// class Bootstraper {
$connectDB1 = new DatabaseMYSQL('localhost', 'root', '', 'sistema_precios'); // Conexion Constante
// $connectDB2 = new DatabaseMYSQL('$server', '$usuario', '$pass', 'cugat_gestion00'); // Conexion Variable segun el CBO
$connectDB2 = new DatabaseMYSQL('localhost', 'root', '', 'cugat_gestion00'); // Conexion Variable segun el CBO
                            //  IP de surcursal segun el combobx
    // }
