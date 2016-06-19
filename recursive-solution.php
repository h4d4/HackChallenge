<?php

$query_list = array( );

function read () {
  $line = fgets(STDIN);
  $arr = explode("\n", $line);
  $arr2 = explode(" ", $arr[0]);
  return $arr2;
}

function clear (&$query_list) {
  $query_list = array();
}

function update_process ($x,  $y, $z, $val, &$query_list) {
  $key = (string)$x . ";" . (string)$y . ";" . (string)$z;
  $query_list [$key] = $val;
}

function query_process ($x1, $y1, $z1, $x2, $y2, $z2, &$query_list) {

  $sum = 0;

  foreach ($query_list as $key => $value) {

    $point_updated = explode(";", $key); //point updated so it's storaged in $query_list

      if ( $point_updated[0] >= $x1 && $point_updated[1] >= $y1 && $point_updated[2] >= $z1 &&  
          $point_updated[0] <= $x2 && $point_updated[1] <= $y2 && $point_updated[2] <= $z2 )
        $sum += $query_list[$key];
  }
  print("sum:" . $sum."\n");
}


function main(){

  $in = read();
  $TEST = (int)$in[0];

  for ($i = 0; $i < $TEST; $i++) {
    
    clear($query_list);

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
        update_process($x, $y, $z, $val, $query_list); 

      }
      else {
        $x1 = (int)$query[1];
        $y1 = (int)$query[2];
        $z1 = (int)$query[3];

        $x2 = (int)$query[4];
        $y2 = (int)$query[5];
        $z2 = (int)$query[6];

        query_process( $x1, $y1, $z1, $x2, $y2, $z2, $query_list);
      }
    }
  }
  //print_r($query_list);
}

main();
//LIMPIAR ARRAY

?>