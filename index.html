<html><body><?php
// Written by George Carroll
// ...with a lot of help from Joshua Carroll

require 'config.php';
require "repeaters.class.php";

$repeaters = new Repeaters();

echo json_encode($repeaters);

$message = "";
foreach ($repeaters->entries as $repeater) {
	if (!$repeater->healthyVoltage) {
		$message .= "The " . $repeater->callsign . " repeater has a low power reading. It currently reads " . $repeater->voltage . ". ";
	}
    if (!$repeater->healthyGridPower) {
            $message .= "The " . $repeater->callsign . " repeater is reporting no grid power. ";
    }
    if (!$repeater->healthyStatusTime) {
            $message .= "The " . $repeater->callsign . " repeater has not reported-in for " . $repeater->minutesSinceLastHeard() . " minutes. ";
    }
}
if ($message != "") {
    pushNotification($message);
    echo "<hr>" . $message;
}

?>
</body></html>
