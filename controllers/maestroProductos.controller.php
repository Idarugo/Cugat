<?php
require __DIR__ . '../../models/MaestroProductos_Fijo.php';
require __DIR__ . '../../models/MaestroProductos_Ofertas.php';
require __DIR__ . '../../models/MaestroProductos_Precios.php';
require __DIR__ . '../../models/MaestroProductos.php';


class MaestroProductosController
{
    private $connectDB2;

    function __construct($connectDB2)
    {

        $this->connectDB2 = $connectDB2;
    }

    /*-------------- CONSULTAR PRECIO FIJO --------------------------------------------------------------*/

    public function buscarPrecios($local, $codigobarra)
    {
        $precioFijo = array();
        $this->connectDB2->connect();
        $sql = "SELECT  a.codigobarra AS CODIGO, a.descripcion AS DESCRIPCION,a.pcosto AS PRECIO_COSTO, b.preciopuntoventa AS PRECIO_FIJO,b.local AS LOCAL
        FROM cugat_gestion00.r_maestroproductos_fijo_00 AS a, cugat_gestion00.r_maestroproductos_precios_00 AS b
        WHERE a.codigobarra=b.codigo AND a.codigobarra='$codigobarra' AND b.local='$local'";
        $st = $this->connectDB2->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $precioFijo[] = ["local" => $rs['LOCAL'], "codigo" => $rs['CODIGO'], "descripcion" => $rs['DESCRIPCION'], "precio_costo" => $rs['PRECIO_COSTO'], "precio_fijo" => $rs['PRECIO_FIJO']];
        }
        $this->connectDB2->disconnect();
        return $precioFijo;
    }

    /*---------------CONSULTAR OFERTA UNITARIA-----------------------------------------------------------*/

    public function buscarPrecioUnitario($local, $codigobarra)
    {
        $precioOferta = array();
        $this->connectDB2->connect();
        $sql = "SELECT a.codigobarra AS CODIGO, a.descripcion AS DESCRIPCION, b.cantidad AS CANTIDAD,
        b.precio AS PRECIO_OFERTA, b.desde AS DESDE, b.hasta AS HASTA, 
        CONCAT(
            MOD(FLOOR(DATEDIFF(b.hasta, b.desde) / 30), 12), ' meses ',
            DATEDIFF(b.hasta, DATE_ADD(b.desde, INTERVAL FLOOR(DATEDIFF(b.hasta, b.desde) / 30) MONTH)), ' días'
        ) AS RESTANTE, b.local AS LOCAL
        FROM cugat_gestion00.r_maestroproductos_fijo_00 AS a, cugat_gestion00.r_maestroproductos_3x_00 AS b
        WHERE a.codigobarra = b.codigo AND a.codigobarra = '$codigobarra' AND LOCAL = '$local';";
        $st = $this->connectDB2->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $precioOferta[] = ["local" => $rs['LOCAL'], "codigo" => $rs['CODIGO'], "descripcion" => NULL, "cantidad" => NULL, $rs['PRECIO_OFERTA'], "desde" => $rs['DESDE'], "hasta" => $rs['HASTA'], $rs['RESTANTE']];
        }
        $this->connectDB2->disconnect();
        return $precioOferta;
    }

    /*---------------CONSULTA OFERTA PESABLE -------------------------------------------------------------*/
    public function buscarPrecioPesable($local, $codigobarra)
    {
        $precioOferta = array();
        $this->connectDB2->connect();
        $sql = "SELECT a.codigobarra AS CODIGO, a.descripcion AS DESCRIPCION, b.cantidad AS CANTIDAD,b.preciooferta AS PRECIO_OFERTA, b.fechainicio AS DESDE,b.fechatermino AS HASTA,b.local AS LOCAL 
        FROM cugat_gestion00.r_maestroproductos_fijo_00 AS a,cugat_gestion00.r_maestroproductos_ofertas_00 AS b
        WHERE a.codigobarra=b.codigo AND a.codigobarra='$codigobarra' AND b.local = '$local' and b.`fechatermino` > now();";
        $st = $this->connectDB2->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $fecha1 = new DateTime(date("Y-m-d"));
            $fecha2 = new DateTime($rs["HASTA"]);
            $diferencia = $fecha1->diff($fecha2);
            $dias = $diferencia->days;
            $dias = $dias . " dias";

            $precioOferta[] = ["cantidad" => $rs["CANTIDAD"], "p_oferta" => $rs["PRECIO_OFERTA"], "desde" => $rs["DESDE"], "hasta" => $rs["HASTA"], "dias_restantes" => $dias];
        }
        $this->connectDB2->disconnect();
        return $precioOferta;
    }


    // public function buscarPrecios($local, $codigobarra)
    // {
    //     $precioFijo = array();
    //     $this->connectDB2->connect();
    //     $sql = "SELECT  a.codigobarra AS CODIGO, a.descripcion AS DESCRIPCION,a.pcosto AS PRECIO_COSTO, b.preciopuntoventa AS PRECIO_FIJO,b.local AS LOCAL
    //     FROM cugat_gestion00.r_maestroproductos_fijo_00 AS a, cugat_gestion00.r_maestroproductos_precios_00 AS b
    //     WHERE a.codigobarra=b.codigo AND a.codigobarra='$codigobarra' AND b.local='$local'";
    //     $st = $this->connectDB2->query($sql);
    //     while ($rs = mysqli_fetch_array($st)) {
    //         $precioFijo[] = new MaestroProductosFijo($rs['local'], $rs['CODIGO'], $rs['DESCRIPCION'],  $rs['PRECIO_COSTO'],  $rs['PRECIO_FIJO'], null, null, null, null, null, null, NULL);;
    //     }
    //     $this->connectDB2->disconnect();
    //     return $precioFijo;
    // }


    public function updatePrecio($codigobarra, $preciopuntoventa)
    {
        $this->connectDB2->connect();
        $sql = "UPDATE cugat_gestion00.r_maestroproductos_precios_00  SET preciopuntoventa='$preciopuntoventa' WHERE codigo='$codigobarra' AND LOCAL='00' ;";
        $this->connectDB2->query($sql);
        if ($this->connectDB2->getDB()->affected_rows) {
            $this->connectDB2->disconnect();
            $_SESSION['Msj'] = "1";
            header("location: ../pages/admin/sidebar/maestro-precio.php");
            exit();
        }
        $this->connectDB2->disconnect();
        $_SESSION['Msj'] = "-1";
        header("location: ../pages/admin/sidebar/maestro-precio.php");
        exit();
    }

    public function updatePrecioOferta($codigobarra, $precio, $cantidad, $desde, $hasta)
    {
        session_start();
        $this->connectDB2->connect();
        //$sql = "UPDATE cugat_gestion00.r_maestroproductos_ofertas_00  SET preciooferta='$precio' WHERE `codigo`='$codigobarra'  AND LOCAL='00';";
        $sql = "UPDATE cugat_gestion00.r_maestroproductos_3x_00  SET precio='$precio' , cantidad='$cantidad' , desde='$desde' , hasta='$hasta'  WHERE codigo='$codigobarra'  AND LOCAL='00';";
        $this->connectDB2->query($sql);
        if ($this->connectDB2->getDB()->affected_rows) {
            $this->connectDB2->disconnect();
            $_SESSION['Msj'] = "MaestroPrecio_Modificar";
            header("location: ../pages/admin/sidebarmaestro-precio.php");
            exit();
        }
        $this->connectDB2->disconnect();
        $_SESSION['Msj'] = "MaestroPrecio_Error";
        header("location: ../pages/admin/sidebar/maestro-precio.php");
        exit();
    }
}
