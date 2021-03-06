<?php
Class HackSolution {

  public $query_list = array( );

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

        if ( $point_updated[0] >= $x1 && $point_updated[1] >= $y1 && $point_updated[2] >= $z1 &&  $point_updated[0] <= $x2 && 
             $point_updated[1] <= $y2 && $point_updated[2] <= $z2 ) 
          $sum += $query_list[$key];
      }
      print($sum."\n");
  }

  function main () {
    $in = $this->read();
      $TEST = (int)$in[0];
   
    if ( $TEST < 1 || $TEST > 50 ) {
      print("T = $TEST is out of range [1,50]\n");
        exit(1);
    }
  
      for ($i = 0; $i < $TEST; $i++) {
        $this->clear($query_list);
        $in = $this->read();
        $n = (int)$in[0];
        $m = (int)$in[1];

        if( $n < 1 || $n > 100 ) {
            print("N = $n is out of range [1,100]\n");
            exit(1);
        }
        if( $m < 1 || $m > 1000 ) {
            print("M = $m is out of range [1,1000]\n");
            exit(1);
        }

        for ($j = 0; $j < $m; $j++) {
          $query = $this->read();
            if ($query[0] === "UPDATE") {
              $x = (int)$query[1];
              $y = (int)$query[2];
              $z = (int)$query[3];
              $w = (int)$query[4];

              if ( $x < 1 || $x > $n ) {
                print("X = $x value is out of range [1,N] with N = $n\n");
                  exit(1);
              }
              if ( $y < 1 || $y > $n ) {
                 print("Y = $y  is out of range [1,N] with N = $n\n");
                 exit(1);
              }
              if ( $z < 1 || $z > $n ) {
                print("Z = $z is out of range [1,N] with N = $n\n");
                  exit(1);
              }
              if ( $w < pow(-10,9) || $w > pow(10,9) ) {
                  print("W = $w value is out of range [-10 pow 9,10 pow 9]\n");
                  exit(1);
              }

              $this->update_process($x, $y, $z, $w, $query_list); 
          }
          elseif ($query[0] === "QUERY") {
            $x1 = (int)$query[1];
            $y1 = (int)$query[2];
            $z1 = (int)$query[3];

            $x2 = (int)$query[4];
            $y2 = (int)$query[5];
            $z2 = (int)$query[6];

            if ( $x1 < 1 || $x1 > $n ) {
              print("X1 = $x1 value is out of range [1,100]\n");
                exit(1);
            }
            if ( $y1 < 1 || $y1 > $n ) {
              print("Y1 value is out of range [1,100]\n");
                exit(1);
            }
            if ( $z2 < 1 || $z2 > $n ) { 
               print("Z2 value is out of range [1,100]\n");
               exit(1);
            }
            if ( $x2 < 1 || $x2 > $n ) { 
               print("X2 value is out of range [1,100]\n");
               exit(1);
            }
            if ( $y2 < 1 || $y2 > $n ) { 
              print("Y2 value is out of range [1,100]\n");
              exit(1);
            }
            if ( $z2 < 1 || $z2 > $n ) { 
               print("Z2 value is out of range [1,100]\n");
               exit(1);
            }

            $this->query_process( $x1, $y1, $z1, $x2, $y2, $z2, $query_list);

          }
        }
      }
    }
}
$solution = new HackSolution();
$solution->main();
?>