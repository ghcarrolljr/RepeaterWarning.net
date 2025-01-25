<?php

require "repeater.class.php";
require "utilities.php";

class Repeaters {
	public $aprsFiData;
	private $jsonUrl;
	public $reportTime;
	public $telemetry;
	public $entries;

	function __construct() {
		$this->jsonUrl = "https://api.aprs.fi/api/get?name=W5AUU-1,W5AUU-2,W5AUU-3&what=loc&apikey=100665.Mj8HjUvXqEHYjrV6&format=json";
		$jsonData = getJson($this->jsonUrl);
		$this->aprsFiData = json_decode($jsonData, true);

		$this->entries = new stdClass();

		// Load telemetry from the json file. This file is populated with data directly from the APRS
		// central database. It is written to constantly. The telemetry isn't avaialble from APRS.fi
		$this->telemetry = new stdClass();
		$jsonData = file_get_contents("repeaterTelemetry.json",true);
                $this->telemetry = json_decode($jsonData, true);

		date_default_timezone_set("America/Chicago");
		$this->reportTime = date("d/m/Y h:i:sa");

		//$this->addRepeater("W5AUU-1", 0, 5);
                $this->addRepeater("W5AUU-2", 1, 5);
                $this->addRepeater("W5AUU-3", 2, 3);
	}

	private function addRepeater($repeaterCallsign, $aprsFiEntryIndex, $telemetryGridPowerStatusChannel) {
		$this->entries->{$repeaterCallsign} = new Repeater($repeaterCallsign, $this->aprsFiData["entries"][$aprsFiEntryIndex], $this->telemetry[$repeaterCallsign], $telemetryGridPowerStatusChannel);
	}
}

?>
