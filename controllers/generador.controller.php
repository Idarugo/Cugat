<?php

class GeneradorController
{

    public function generarHoraEspecialidad($hora_i, $hora_f, $tiempo)
    {
        $lista = array();
        $lista[] = $hora_i;
        while ($hora_i != $hora_f) {
            $hora = new DateTime($hora_i);
            $hora->modify('+' . $tiempo . ' minute');
            $result = $hora->format('H:i');
            $lista[] = $result;
            $hora_i = $result;
        }
        return $lista;
    }

    public function generarDivisionSeleccion($cantidad_datos, $cantidad_muestra)
    {
        $arreglo = array();
        $variable = 0;
        for ($i = 0; $i <= $cantidad_datos; $i++) {
            if ($i % $cantidad_muestra == 0 and $i != 0) {
                array_push($arreglo, [$variable, $i - 1]);
                $variable = $i;
            }
            if ($i == $cantidad_datos) {
                if ($i % $cantidad_muestra != 0) {
                    array_push($arreglo, [$variable, $i - 1]);
                }
            }
        }
        return $arreglo;
    }


    public function validarIndices($arreglo, $indice_array, $pagina_actual)
    {
        $cantidad_array = count($arreglo) - 1;
        if ($indice_array > $cantidad_array) {
            $indice_inicio = $arreglo[$cantidad_array][0];
            $indice_fin = $arreglo[$cantidad_array][1];
            $pagina_actual = $cantidad_array + 1;
            return [$indice_inicio, $indice_fin, $pagina_actual];
        } else {
            $indice_inicio = $arreglo[$indice_array][0];
            $indice_fin = $arreglo[$indice_array][1];
            return [$indice_inicio, $indice_fin, $pagina_actual];
        }
    }
}
