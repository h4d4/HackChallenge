<?php







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
        update_process(); //

      }
      else {
        $x1 = (int)$query[1];
        $y1 = (int)$query[2];
        $z1 = (int)$query[3];

        $x2 = (int)$query[4];
        $y2 = (int)$query[5];
        $z2 = (int)$query[6];

        query_process(); //
      }
    }
  }

}

main();

?>