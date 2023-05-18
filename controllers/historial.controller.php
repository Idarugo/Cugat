<?php
require_once '../models/historial.php';
class HistorialController
{
    private $connectDB2;

    function __construct($connectDB2)
    {

        $this->connectDB2 = $connectDB2;
    }

    public function get_Historial()
    {
        $this->connectDB2->connect();
        $lista = array();
        $estado = 1;
        $stmt = $this->connectDB2->prepare("SELECT * FROM historial_descuento WHERE estado = ?");
        $stmt->bind_param("i", $estado);
        $stmt->execute();
        $st = $stmt->get_result();
        while ($rs = mysqli_fetch_array($st)) {
            $lista[] = ["codigo_barra" => $rs['codigo_producto'], "precio_antiguo" => $rs['precio_antiguo'], "precio_nuevo" => $rs["precio_nuevo"], "expiracion" => $rs["fecha_expiracion"]];
        }
        $this->connectDB2->disconnect();
        return $lista;
    }

    public function update_Precio_Oferta($codigo_barra, $precio_nuevo, $expiracion)
    {
        $this->connectDB2->connect();
        $stmt = $this->connectDB2->prepare("SELECT b.precio_punto_venta as precio_antiguo FROM catalogo_productos.producto as b WHERE b.codigo_barra = ?");
        $stmt->bind_param("s", $codigo_barra);
        $stmt->execute();
        $rs = $stmt->get_result()->fetch_assoc();
        $precio_antiguo = $rs['precio_antiguo'];
        $stmt = $this->connectDB2->prepare("INSERT INTO historial_descuento(codigo_producto,precio_antiguo,precio_nuevo,fecha_expiracion) VALUES (?,?,?,?)");
        $stmt->bind_param("siis", $codigo_barra, $precio_antiguo, $precio_nuevo, $expiracion);
        $stmt->execute();
        $stmt = $this->connectDB2->prepare("UPDATE catalogo_productos.producto as b SET b.precio_punto_venta = ? WHERE b.codigo_barra = ?");
        $stmt->bind_param("is", $precio_nuevo, $codigo_barra);
        $stmt->execute();
        header("Location: ../pages/index.php?msg=4");
    }
}
