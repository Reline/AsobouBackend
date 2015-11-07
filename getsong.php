<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	connectToDB();

	// get one or all songs
	$safe_song_id = mysqli_real_escape_string($mysqli, $_GET['ID']);
	
	if ($safe_song_id == "*") { // gotta catch em all
		$get_songs_query = "SELECT * FROM Song";
		$get_songs_response = mysqli_query($mysqli, $get_songs_query) or die(mysqli_error($mysqli));

		// JSONArray
		$songdata = '[';
		while($row = mysqli_fetch_assoc($get_songs_response)) {
			$songdata .= json_encode($row);
			$songdata .= ",";
		}
		mysqli_free_result($get_songs_response);
		mysqli_close($mysqli);
		$songdata = trim($songdata, ",");
		$songdata .= "]";

		echo $songdata;
		
	} else { // you only get a starter
		$get_song_query = "SELECT * FROM Song WHERE ID = " . $safe_song_id;
		$get_song_response = mysqli_query($mysqli, $get_song_query) or die(mysqli_error($mysqli));

		$songdata = "";
		$row = mysqli_fetch_assoc($get_song_response);
		$songdata .= json_encode($row);
		
		echo $songdata;
		mysqli_free_result($get_player_response);
		mysqli_close($mysqli);
	}

?>
