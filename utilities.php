<?php

function write($message) {
	echo "<h3>" . $message . "</h3>";
}

function pushNotification($message) {
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    curl_setopt_array($ch = curl_init(), array(
      CURLOPT_URL => "https://api.pushover.net/1/messages.json",
      CURLOPT_POSTFIELDS => array(
        "token" => "a421kzttscw9qk3wkc2bew4ok6y118",
        "user" => "ut7cekskohg9d4vt27khzcv7qjysuj",
        "message" => $message,
      ),
      CURLOPT_SAFE_UPLOAD => true,
      CURLOPT_RETURNTRANSFER => true,
    ));
    curl_exec($ch);
    curl_close($ch);
}

function getJson($url) {

	$loadJsonFromUrl = false;

	// cache files are created like cache/abcdef123456...
	$cacheFilename = 'cache' . DIRECTORY_SEPARATOR . md5($url);

	if (file_exists($cacheFilename)) {
		$file = fopen($cacheFilename, 'r');
                $cacheTime = trim(fgets($file));

                // if data was cached recently, return cached data
                if ($cacheTime > strtotime('-5 minutes')) {
                        return fread($file,filesize($cacheFilename));
                }
		else {
			$loadJsonFromUrl = true;
	                fclose($file);
        	        unlink($cacheFilename);
		}
	}
	else {
		$loadJsonFromUrl = true;
	}

	if ($loadJsonFromUrl) {
        	$json = file_get_contents($url);
        	$file = fopen($cacheFilename, 'w');
        	fwrite($file, time() . "\n" . $json);

        	fclose($file);
        	return $json;
	}
}

?>
