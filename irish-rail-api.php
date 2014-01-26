<?php
	header('Content-type: application/json');

	$station = $_REQUEST['station'];
	$mins = $_REQUEST['mins'];
	$traintype = $_REQUEST['traintype'];

	getStationTimes($station, $mins, $traintype);

	function getStationTimes($station, $mins, $traintype) {
		$queryParams = array(
			'StationDesc' => $station,
			'NumMins' => $mins,
			'Traintype' => $traintype
		);

		$baseUrl = "http://api.irishrail.ie/realtime/realtime.asmx/getStationDataByNameXML_withNumMins";

		$xmlContents = file_get_contents($baseUrl . '?' . http_build_query($queryParams));
		$xml = simplexml_load_string($xmlContents);

		$trains = str_replace("objStationData", "trains", json_encode($xml));

		echo $trains;
	}
?>
