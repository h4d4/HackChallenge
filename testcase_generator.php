<?php
Class testGenerator {

	function printing ($data,$file_dir) {
		$file = fopen($file_dir,"w");
		fwrite($file, $data);
		fclose($file);
	}
	/*  generate operations 
		$M -> operation amount, $N -> cube size 
		$w -> array, W range
		$n -> array, axes ranges,depends of N
	*/
	function operation ($M,$n,$w) {
		$m = abs($M);
		$op_type = "";
		$operations = "";

		for ($i = 0; $i < $m; $i++) { //operations number
			if (rand(0, 1) == 0)
				$op_type = "UPDATE";
			else
				$op_type = "QUERY";

			if ($op_type == "UPDATE") {
				$operations= $operations . "UPDATE" . " ".rand($n[0],$n[1]) . " ". rand($n[0],$n[1]) . " ".rand($n[0],$n[1]) . " ". 
				rand( (int)pow($w[0],$w[1]), (int)pow($w[2],$w[3]) ) . "\n";
			}

			if ($op_type == "QUERY") {
				$operations = $operations. "QUERY". " ".
				rand($n[0],$n[1]) . " ". rand($n[0],$n[1]) . " ".rand($n[0],$n[1]). " ".
				rand($n[0],$n[1]) . " ". rand($n[0],$n[1]) . " ".rand($n[0],$n[1]). "\n";
			}
		}

		return $operations;

	}
	/* testcase structure 
		$cs -> testcase type(1,2,3,4,5)
		operation ($M,$n,$w,)
	*/
	function testcase ($cs,$limit,$fdir) { //
		$testcase = "";
		$M = 0; $T = 0; $N = 0;
		$n = array(); //range of N
		$W = array();

		if ($cs == 1) { 
			if ($limit=="low")
				$T = rand(-100,0);
			elseif ($limit=="upp")
				$T = rand(51,100);
			else {
				print("Second argument shuld be: low or upp");
				exit();
			}
			$M = 5; 
			$N = rand(1,100);
			$n[0] = 1; $n[1] = $N ;
			$W[0] = -10; $W[1] = 9; $W[2] = 10; $W[3] = 9;
		}
		elseif ($cs == 2) {
			if ($limit=="low")
				$N = rand(-100,0);
			elseif ($limit=="upp")
				$N = rand(101,1000);
			else {
				print("Second argument shuld be: low or upp");
				exit();
			}
			$T = 10; 
			$M =  5;
			$n[0] = 1; $n[1] = $N ;
			$W[0] = -10; $W[1] = 9; $W[2] = 10; $W[3] = 9;
		}
		elseif ($cs == 3) {
			if ($limit=="low")
				$M = rand(-100,0);
			elseif ($limit=="upp")
				$M = rand(1001,1500);
			else {
				print("Second argument shuld be: low or upp");
				exit();
			}
			$T = 10; 
			$N = rand(1,100);
			$n[0] = 1; $n[1] = $N ;
			$W[0] = -10; $W[1] = 9; $W[2] = 10; $W[3] = 9;
		}
		elseif ($cs == 4) {
			if ($limit=="low") {
				$W[0] = -10; $W[1] = 13; $W[2] = -10; $W[3] = 11;
			}
			elseif ($limit=="upp") {
				$W[0] = 10; $W[1] = 11; $W[2] = 10; $W[3] = 13;
			}
			else {
				print("Second argument shuld be: low or upp");
				exit();
			}
			$T = 10; 
			$M = 5;
			$N = rand(1,100);
			$n[0] = 1; $n[1] = $N ;
		}
		elseif ($cs == 5) {
			if ($limit=="low") {
				$n[0] = -100; $n[1] = 0 ;
			}
			elseif ($limit=="upp") {
				$n[0] = 101; $n[1] = 500 ;
			}
			else {
				print("Second argument shuld be: low or upp");
				exit();
			}
			$T = 10; 
			$M = 5;
			$N = rand(1,100);
			$W[0] = -10; $W[1] = 9; $W[2] = 10; $W[3] = 9;
		}
		else{
			print("No input to case option");
			exit();
		}

		$testcase = $testcase . "$T \n";

		for($i = 0; $i < abs($T); $i++ ){
			$testcase = $testcase .  "$N " . "$M\n" . $this->operation($M,$n,$W);
		}

		$this->printing($testcase,$fdir);
	}

	function generate_all_cases ($dir) {
		$filename = ""; $case = "";
		for ($i = 1; $i < 6; $i++) {
			if($i == 1)
				$case = "T";
			if($i == 2)
				$case = "N";
			if($i == 3)
				$case = "M";
			if($i == 4)
				$case = "W";
			if($i == 5)
				$case = "XYZ";
			$filename = $dir . "/" . $case . "-low-limits.txt";

			$this->testcase($i,"low",$filename); 
		}
		for ($i = 1; $i < 6; $i++) {
			if($i == 1)
				$case = "T";
			if($i == 2)
				$case = "N";
			if($i == 3)
				$case = "M";
			if($i == 4)
				$case = "W";
			if($i == 5)
				$case = "XYZ";

			$filename = $dir . "/" . $case . "-upp-limits.txt";
			$this->testcase($i,"upp",$filename); 
		}
		
	}

	function case_by_case ($test,$dir) {
		$case = "";
		if($test == 1)
			$case = "T";
		if($test == 2)
			$test = "N";
		if($test == 3)
			$case = "M";
		if($test == 4)
			$case = "W";
		if($test == 3)
			$case = "XYZ";
			$filename = $dir . "/" . $case . "-low-limits.txt";

		$this->testcase($test,"low",$dir); 
		$this->testcase($test,"upp",$dir); 
	}

	function main($op,$dir,$case) {
		if ((int)$op == 0 && $case === "") {
			$this->generate_all_cases($dir);
		}
		elseif ((int)$op == 1) {
			if ((int)$case > 0 && (int)$case < 6) {
				$this->case_by_case($case,$dir);
			}
		}
	}
}
/*
	main($op,$dir,$case)
		$op -> 
			0: generate_all_cases() 
			1: case_by_case()
		$dir -> path to write testcases
		$case ->
			: "" , vacio; Exam: 
			: number into 1 and 5, to generate testcase by testcase; Exam: $test ->main(1,"testcases","4");
	*/
$test = new testGenerator();
$test ->main(0,"testcases","");
//$test ->main(1,"testcases","4");

?>