<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php'

	connectToDB();

	// clean
	$safe_player_digits_id = mysqli_real_escape_string($mysqli, $_GET['PlayerDigitsID']);
	$safe_song_id = mysqli_real_escape_string($mysqli, $_GET['SongID']);
	
	if ($safe_song_id == "*") {
		// get all scores for user
		$get_all_scores_query = "SELECT * FROM Score WHERE PlayerDigitsID = " . $safe_player_digits_id;
		$get_all_scores_response = mysqli_query($mysqli, $get_all_scores_query) or die(mysqli_error($mysqli));
	
		// json array
		$scoreinfo = '[';
		while($row = mysqli_fetch_assoc($get_all_scores_response)) {
			$scoreinfo .= json_encode($row);
			$scoreinfo .= ",";
		}
		mysqli_free_result($get_all_scores_response);
		mysqli_close($mysqli);
	
		$scoreinfo = trim($scoreinfo, ","); // get rid of whitespace
		$scoreinfo .= ']';
		echo $scoreinfo;
	} else {
		// get specified score for user
		$get_score_query = "SELECT * FROM Score WHERE PlayerDigitsID = " . $safe_player_digits_id . " AND SongID = " . $safe_song_id;
		$get_score_response = mysqli_query($mysqli, $get_score_query) or die (mysqli_error($mysqli));

		$scoredata = "";
		$row = mysqli_fetch_assoc($get_score_response);
		$scoredata .= json_encode($row);

		echo $scoredata;
		mysqli_free_result($get_player_response);
		mysqli_close($mysqli);
	}
?>
