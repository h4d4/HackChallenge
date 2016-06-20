<?php
Class testGenerator {
	//constrains
	const T = 50; //max testcases
	const N = 100; //matrix size
	const M = 1000; //operations's amount
	
	// function __construct() {
	// 	self::main();
	// }

	function printing ($data) {
		$file = fopen("testcases.txt","w");
		fwrite($file, $data);
		fclose($file);
	}

	function worst_cases ($case,$cube_size) { //generate works cases
		$N = $cube_size; 
		$M = self::M;
		$query = ""; $update = "";
		$q = 0; $u = 0;
 
		if ($case == 1) {
			$q = 1;
			$u = $M  - 1;
		}
		if ($case == 2) {
			$q = 500;
			$u = 500;
		}
		if ($case == 3) {
			$q = $M  - 1;
			$u = 1;
		}
		for ($m = 0; $m < $u; $m++) { 
			$update = $update . "UPDATE" . " ".rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N). " ". 
			rand(pow(-10,9),  pow(10,9)). "\n";
		}
		for ($m = 0; $m < $q; $m++) {
				$query = $query. "QUERY". " ".
				rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N). " ".
				rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N). "\n";
		}
		
		return $update . $query;
	}

	function operations ($op, $cube_size) { 	//generate operations's amount
		$N = $cube_size;
		$op_type = ""; $operations = "";

		for ($m = 0; $m < $op; $m++) { //operations number
			if ( rand(0, 1) == 0)
				$op_type = "UPDATE";
			else
				$op_type = "QUERY";

			if ($op_type == "UPDATE") {
				$operations= $operations . "UPDATE" . " ".rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N)." ". 
				rand(pow(-10,9),  pow(10,9)). "\n";
			}

			if ($op_type == "QUERY") {
				$operations = $operations. "QUERY". " ".
				rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N). " ".
				rand(1,$N) . " ". rand(1,$N) . " ".rand(1,$N). "\n";
			}
		}

		return $operations;
	}

	function testcases () { // generate testcases
		$test1 = ""; $wc = ""; $testcases = "";
		$T = self::T; $N = self::N; $M = self::M;
		$num_op = rand(1,$M);
		$num_test = rand(1,$T); //Testcases number
		$cs_test1 = rand(1,$N); //cube size test1

		print("num_test: " . $num_test . "\n");
		print("cube_size: " . $cs_test1 . "\n");

		$num_test() {
			
		}

		for($i = 0; $i < 3; $i++)
			$wc = $wc . $this->worst_cases($i,$cs_test1);

		$test1 = "3\n".$cs_test1." 1000\n". $this->worst_cases(1,$cs_test1);
		$test1 = $test1 . $cs_test1." 1000\n". $this->worst_cases(2,$cs_test1);
		$test1 = $test1 . $cs_test1." 1000\n". $this->worst_cases(3,$cs_test1);
		$testcases = $test1;
/*
		for ($m = 2; $m < $num_op -1; $m++){

			$testcases  = $testcases . operations($num_op,$cube_size);
		}
*/
		//printing($testcases);
		return $testcases;
	}

	function prueba ($valor) {
		print($valor);
		print("\nTESTINGGGG");
	}

	function main () {
		$testcases = $this->testcases() ;
		$this->printing( $testcases );
	}

	// function main () {
	// 	$val = "ssss";
	// 	$this->prueba( $val );
	// }
}
$test = new testGenerator();
$test ->main();

/*
QUERY x1 y1 z1 X2 Y2 Z2 
UPDATE X Y Z W
*/

/*
function type_operation ( $amount ) { //generatin number opertaion

}




function operation () {
	if( rand(0, 1) == 0)
		$op = "UPDATE";
	else
		$op = "QUERY";

	return $op;
}

function do_testcases () {

	$T = 50; $op = 0;
	$file = fopen("testcases.txt","w");

	fwrite($file, "1"."\n");

	for ($t = 1; $t < $T; $t++) { //Testcases number  //Ensure all  testcases
		fwrite($file, $t."\n");
		$N = rand(1,100;
		$M = rand(1,1000);
		fwrite($file, $N." ".$M."\n");
		for ($m = 0; $m < $M; $m++) { //operations number
			if( rand(0, 1) == 0)
				$op = "UPDATE";
			else
				$op = "QUERY";

			if ($op == "UPDATE") {
				$x = rand(1,$N);
				$y = rand(1,$N);
				$z = rand(1,$N);
				$W0 = -24.4645364561;
				$W1 = 24.4645364561;
				$w = rand($W0, $W1);
				fwrite($file, $op." ". $x." ".$y." ".$z." ". $w."\n");
			 }//else () {
				
			// }

		}
	}

	fclose($file);
}	
//do_testcases();
get_points();*/
?>