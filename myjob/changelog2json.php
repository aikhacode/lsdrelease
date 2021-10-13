<?php

$arr = array(
	"version" => "", 
	"slug" => "lsddonation", 
	"download_url" => "https://github.com/",
	"agent" => "Github",
	"changelog" => array(  "version" => "",
							"link" => "https://lsdplugins.com/dev/release/lsddonation/",
							"date" =>	"",
							"improvement" => array(),
							"added" => array(),
							"support" => array(),
							"changed" => array(),
							"deprecated" => array(),
							"removed" => array(),
							"fixed" => array(),
							"security" => array()
		)
);

if ($argc > 2) {
	try {
		$fp = fopen($argv[1], "r");
	} catch (Exception $e) {
		echo 'File does not exist';
	}



	$row = 1;
	$tagchild = false;
	$arr["download_url"] = "https://github.com/" . $argv[2] . "/lsddonation.zip";

	while (($content = fgets($fp)) !== false) {

		//$content = trim($content);
		//echo $row++ . ": " . $content;
		if (strpos($content, "# [v") !== false) {
			if (preg_match("/\[(.*?)\]/", $content, $matches)) {
				$arr["version"] = substr($matches[1],1);
				$arr["changelog"]["version"] = $matches[1];
				$arr["changelog"]["link"] = $arr["changelog"]["link"] . $matches[1];

                // var_dump( $matches);
				// $tag = $matches[1];
				if (preg_match_all("#\((.*?)\)#", $content, $matches)) {
					$arr['changelog']["date"] =  $matches[1][1];
					// var_dump( $matches);
				}
			}
		}



		if (($awal = strpos($content, "**")) !== false) {
			//echo "founded " . $content;


			$akhir = strpos($content, " :**");
			$str = substr($content, $awal + 2, $akhir - $awal - 2);
			$str = strtolower($str);
			//echo $str . PHP_EOL;

			$arr['changelog'][$str] = array();

			//$tagchild = true;
			$tagparent = $str;
		}

		if (($awal = strpos($content, "- ")) !== false) {
			//if ($tagchild){

			array_push($arr['changelog'][$tagparent], trim(substr($content,2)) );

			//}
		}
	}

	fclose($fp);
} else {
	echo 'parameter not enough bro.. parameter: nama_file_md url_repo_download';
}

$fp = fopen('changelog.json', 'w');
fwrite($fp, json_encode($arr));
fclose($fp);

// echo PHP_EOL;
// echo(json_encode($arr, JSON_PRETTY_PRINT));
// echo PHP_EOL;

die();
