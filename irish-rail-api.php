<?php
	header('Content-type: application/json');

	$station = $_REQUEST['station'];

	getStationTimes($station);

	function getStationTimes($station) {
		$queryParams = array(
			'StationDesc' => $station
		);

		$baseUrl = "http://api.irishrail.ie/realtime/realtime.asmx/getStationDataByNameXML";

		$xmlContents = file_get_contents($baseUrl . '?' . http_build_query($queryParams));
		$xml = simplexml_load_string($xmlContents);

		$trains = str_replace("objStationData", "trains", json_encode($xml));

		echo $trains;
	}
?>
