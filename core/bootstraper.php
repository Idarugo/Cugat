<?php
require __DIR__ . '../../database/DatabaseMYSQL.php';
// class Bootstraper {
$connectDB1 = new DatabaseMYSQL('localhost', 'root', '', 'sistema_precio');
$connectDB2 = new DatabaseMYSQL('localhost', 'root', '', 'cugat_gestion00');
    
    // }
