
<?php

Class RunAlgorithm {

	const DIR = "/var/www/testcases/";

	public $upload_files = array();
	public $nf = 0;

	/* Storage uploaded files */
	function upload () {
		if ( isset($_POST['submit']) ) {

			$nfiles = count($_FILES['testcases']['name']);

			if ($nfiles > 0) {

				for ($i = 0; $i < $nfiles; $i++) {

					$tmp_dir = $_FILES['testcases']['tmp_name'][$i];

					if($tmp_dir != ""){

						$file_name = $_FILES['testcases']['name'][$i];
						$dir = self::DIR . $file_name;

						if( move_uploaded_file( $tmp_dir, $dir) ) {
							$this->upload_files[$i] = $dir;

						}
					}
				}
				$this->nf = count($this->upload_files);
			}

		}
	}

	function run () {
		for ($i = 0; $i < $this->nf; $i++ ) {
			$file = $this->upload_files[$i];
			$name = explode("/",$file);
			$name = $name[count($name)-1];
			$command = "php recursive-solution.php < " . $this->upload_files[$i];
			$run = shell_exec($command);
        	echo $to_show;
		}
	}
	
	function main () {
		$this->upload();
		if ( $this->nf > 0) {
			$this->run();
		}else{
			echo "<pre>You didn't upload testcases: ";
		}
	}
}

$execute = new RunAlgorithm();
$execute->main();

?>

