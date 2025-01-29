<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class database {
	public static $address = "localhost";
	public static $username = "ghcarrolljr";
	public static $password = "This15@P@55w0rd";
	public static $schema = "theFile";
}

// Not used but might need to be if you want to alert different ppl for different problems.
$recipients = [
        "typicalSuspects" => "joshcarroll21@gmail.com, 5015140605txtfirstnet-mail.com ",
        "w5auu1Power" => "",
        "w5auu2Power" => "",
        "w5auu3Power" => "",
        "testMode" => "joshcarroll21@gmail.com, 5015140605@txt.firstnet-mail.com"
];

$pushover_token = "a421kzttscw9qk3wkc2bew4ok6y118";
$pushover_user = "ut7cekskohg9d4vt27khzcv7qjysuj";

?>
