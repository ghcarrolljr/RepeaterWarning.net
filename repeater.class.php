<?php

class Repeater {
	private $telemetryVoltageChannel;
	private $telemetryGridPowerStatusChannel;
	private $telemetryTempuratureChannel;
	private $alertWhenRepeaterOfflineMoreThanTheseSeconds = 1800;
	private $alertWhenVoltageDropsBelow = 125;

	public $voltage;
	public $gridPower;
	public $tempurature;
	public $lastStatusTime;
	public $latitude;
	public $longitude;
	public $comment;
	public $status;
	public $healthyVoltage;
	public $healthyGridPower;
	public $healthyStatusTime;
	public $callsign;

	function __construct($repeaterCallsign, $aprsFi, $telemetry, $telemetryGridPowerStatusChannel) {
		// Right now, these are the same for each repeater. However since it's possible that another
		// repeater might be added later that is different, I kept these as variables. If that were
		// to be needed, just add that variable to the constructor method as a parameter.
		$this->telemetryVoltageChannel = "1";
		$this->telemetryGridPowerStatusChannel = $telemetryGridPowerStatusChannel;  //W5AUU-3 needs telemetryGridPowerStatusChannel to be 3
		$this->telemetryTempuratureChannel = "2";

		$this->callsign = $repeaterCallsign;

		$this->lastStatusTime = $aprsFi["status_lasttime"];
		$this->latitude = $aprsFi["lat"];
		$this->longitude = $aprsFi["lng"];
		$this->comment = $aprsFi["comment"];
		$this->status = $aprsFi["status"];

		$this->voltage = $telemetry["telemetry" . $this->telemetryVoltageChannel];
		$this->gridPower = $telemetry["telemetry" . $this->telemetryGridPowerStatusChannel];
		$this->tempurature = $telemetry["telemetry" . $this->telemetryTempuratureChannel];

		$this->HealthCheck();
	}

	private function secondsSinceLastHeard() {
		return time() - $this->lastStatusTime;
	}

	public function minutesSinceLastHeard() {
		return round ($this->secondsSinceLastHeard() / 60);
	}

	function HealthCheck() {
        	//  battery voltage
		if ($this->voltage < $this->alertWhenVoltageDropsBelow) {
			$this->healthyVoltage = false;
        	}
		else {
			$this->healthyVoltage = true;
		}

        	// Test last heard
        	if ($this->secondsSinceLastHeard() > $this->alertWhenRepeaterOfflineMoreThanTheseSeconds) {
			$this->healthyStatusTime = false;
        	}
		else {
			$this->healthyStatusTime = true;
		}

	        //test for grid  power
		if ($this->callsign == "W5AUU-3") {
			if ($this->gridPower > 50) {
	                	$this->healthyGridPower = false;
	                }
	                else {
	                        $this->healthyGridPower = true;
	                }
		}
	        elseif ($this->gridPower < 50) {
			$this->healthyGridPower = false;
	        }
		else {
			$this->healthyGridPower = true;
		}
	}
}

?>
