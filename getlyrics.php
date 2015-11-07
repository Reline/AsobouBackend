<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// start up db
	connectToDB();
	
	// clean
	$safe_lyric_id = mysqli_real_escape_string($mysqli, $_GET['ID']);
	
	// get lyric object
	$get_lyric_query = "SELECT * FROM Lyrics WHERE ID = " . $safe_lyric_id;
	$get_lyric_response = mysqli_query($mysqli, $get_lyric_query) or die(mysqli_error($mysqli));
	
	$lyricdata = "";
	$row = mysqli_fetch_assoc($get_lyric_response);
	$lyricdata .= json_encode($row);

	echo $lyricdata;
	
	mysqli_free_result($get_lyric_response);
	mysqli_close($mysqli);
?>
