<?php 
	include_once("$_SERVER[DOCUMENT_ROOT]/includes/back/connect.php");
	session_start();
	
?>
<html lang="FR-fr">
<head>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/css/style.css">
	<link rel="icon" href="assets/img/favicon.png" />
	<title>Open Innov</title>
</head>
<body onload="loadFunction()">
