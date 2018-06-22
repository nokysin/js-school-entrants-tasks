<?php

/**
 * Создает матрицу размером n * n и заполняет ее по спирали
 *
 * @param int {Number} n - размерность матрицы
 * @returns array {Number[n][n]} - n * n - матрица, заполненная по спирали
 */
function fillSpiralMatrix($n)
{
    $result = [];

    $element = 1;
    $iteration = 1;


    while ($element <= $n * $n) {

        $k = $iteration;

        // from left to right
        for ($y = $k - 1; $y < $n - $k + 1; $y++) {
            $x = $k - 1;
            setValue($result, $x, $y, $element);
            $element++;
        }
        // from up to down
        for ($x = $k; $x < $n - $k + 1; $x++) {
            $y = $n - $k;
            setValue($result, $x, $y, $element);
            $element++;
        }
        // from right to left
        for ($y = $n - $k - 1; $y >= $k - 1; $y--) {
            $x = $n - $k;
            setValue($result, $x, $y, $element);
            $element++;
        }
        // from down to up
        for ($x = $n - $k - 1; $x >= $k; $x--) {
            $y = $k - 1;
            setValue($result, $x, $y, $element);
            $element++;
        }

        $iteration++;
    }

    return $result;
}


/**
 * @param array   $array
 * @param integer $x     Current X position
 * @param integer $y     Current Y position
 * @param integer $value
 *
 * @return void
 */
function setValue(&$array, $x, $y, $value)
{
    if(!empty($array[$x][$y])) {
        return;
    }
    $array[$x][$y] = $value;
}
