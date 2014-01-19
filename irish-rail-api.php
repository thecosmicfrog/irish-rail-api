<?php
	header('Content-type: application/json');

	$station = $_REQUEST['station'];
	$mins = $_REQUEST['mins'];

	$trains = array();

	getStationTimes($station, $mins);

	function getStationTimes($station, $mins) {
		$queryParams = array(
			'StationDesc' => $station,
			'NumMins' => $mins
		);

		$baseUrl = "http://api.irishrail.ie/realtime/realtime.asmx/getStationDataByNameXML_withNumMins";

		$xmlContents = file_get_contents($baseUrl . '?' . http_build_query($queryParams));
		$xml = simplexml_load_string($xmlContents);

		$trains = str_replace("objStationData", "trains", json_encode($xml, JSON_PRETTY_PRINT));

		echo $trains;
	}
?>
