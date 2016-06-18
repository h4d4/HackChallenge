<?php

$matrix = array( array(), array(), array() );

function fulling_matx (&$matrix){
  for ($i = 0; $i <= 101; $i++){
    for( $j = 0; $j <= 101; $j++ ){
      for( $k = 0; $k<= 101; $k++ ){
        $matrix[$i][$j][$k] = 0;
      }
    }
  }
}

function update($n, $x,  $y, $z, $val, &$matrix) {
  while($z <= $n) {
    $x1 = $x;
    while($x1 <= $n) {
      $y1 = $y;
      while($y1 <= $n) {
        $matrix[$x1][$y1][$z] += $val;
        $y1 += ($y1 & -$y1 );
      }
      $x1 += ($x1 & -$x1);
    }
    $z += ($z & -$z);
  }
}

function calculate_sum ($x, $y, $z, &$matrix) {
  $y1; $x1; $sum = 0;
  while ($z > 0) {
    $x1 = $x;
    while($x1>0) {
      $y1 = $y;
      while($y1 > 0) {
        $sum +=  $matrix[$x1][$y1][$z];
        $y1 -= ($y1 & -$y1);
      }
      $x1 -= ($x1 & -$x1);
    }
    $z -= ($z & -$z);

  }
  return $sum;
}

function update_process ($n, $x, $y, $z, $val, &$matrix) {

  $x0 = $x;
  $y0 = $y;
  $z0 = $z ;

  $value1 = calculate_sum($x, $y, $z, $matrix) - calculate_sum($x0 - 1, $y, $z, $matrix)
    - calculate_sum($x, $y0 - 1, $z, $matrix) + calculate_sum($x0 - 1, $y0 - 1, $z, $matrix);
  $value2 = calculate_sum($x, $y, $z0 - 1, $matrix) - calculate_sum($x0 - 1, $y, $z0 - 1, $matrix)
    - calculate_sum($x, $y0 - 1, $z0 - 1, $matrix)  + calculate_sum($x0 - 1, $y0 - 1, $z0 -1,$matrix);

  update($n, $x, $y, $z, $val -($value1 - $value2 ), $matrix);
}

function query_process ($x0, $y0, $z0, $x, $y, $z, &$matrix) {
  $value1 = calculate_sum($x, $y, $z, $matrix) - calculate_sum($x0 - 1, $y, $z, $matrix)
    - calculate_sum($x, $y0 - 1, $z, $matrix) + calculate_sum($x0 -1, $y0 - 1, $z, $matrix);

  $value2 = calculate_sum($x, $y, $z0 - 1, $matrix) - calculate_sum($x0 - 1, $y, $z0 - 1, $matrix)
    - calculate_sum($x, $y0 -1, $z0 - 1, $matrix)  + calculate_sum($x0 - 1, $y0 - 1, $z0 -1,$matrix);

  print($value1 - $value2);
  print("\n");
  //PrintMatrix(n);
}

function read () {
  $line = fgets(STDIN);
  $arr = explode("\n", $line);
  $arr2 = explode(" ", $arr[0]);
  return $arr2;
}

function main(){

  $in = read();
  $TEST = (int)$in[0];

  for ($i = 0; $i < $TEST; $i++) {
    fulling_matx($matrix);

    $in = read();
    $n = (int)$in[0];
    $m = (int)$in[1];

    for ($j = 0; $j < $m; $j++) {
      $query = read();
      if ($query[0] === "UPDATE") {
        $x = (int)$query[1];
        $y = (int)$query[2];
        $z = (int)$query[3];
        $val = (int)$query[4];
        update_process($n,$x,$y,$z,$val,$matrix);

      }
      else {
        $x1 = (int)$query[1];
        $y1 = (int)$query[2];
        $z1 = (int)$query[3];

        $x2 = (int)$query[4];
        $y2 = (int)$query[5];
        $z2 = (int)$query[6];

        query_process($x1,$y1,$z1,$x2,$y2,$z2,$matrix);
      }
    }
  }
}
main();

?>