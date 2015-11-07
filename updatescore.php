<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';


	if($_POST) {
		//check required fields
		if(!$_POST['SongID'] || !$_POST['PlayerDigitsID'] || !$_POST['Score'] || !$_POST['ArchivedDate']) {
			echo "Check required fields";
			exit();
		}

		// start db
		connectToDB();

		// clean input
		$safe_song_id = mysqli_real_escape_string($mysqli, $_POST['SongID']);
		$safe_player_digits_id = mysqli_real_escape_string($mysqli, $_POST['PlayerDigitsID']);
		$safe_score = mysqli_real_escape_string($mysqli, $_POST['Score']);
		$safe_date = mysqli_real_escape_string($mysqli, $_POST['ArchivedDate']);

		// get the id of this record, if it exists
		$get_score_id_query = "SELECT ID FROM Score WHERE SongID = '" . $safe_song_id . "' AND PlayerDigitsID = '" . $safe_player_digits_id . "'";
		$get_score_response = mysqli_query($mysqli, $get_score_id_query) or die(mysqli_error($mysqli));
		
		// check if the record already exists
		if(mysql_num_rows($get_score_response) != 0) {
			// update if it does
			$edit_score_query = "UPDATE Score SET Score = '" . $safe_score . "', ArchivedDate = '" . $safe_date . "' WHERE SongID = " . $safe_song_id . "AND PlayerDigitsID = " . $safe_player_digits_id;
			$edit_score_response = mysqli_query($mysqli, $edit_score_query) or die(mysqli_error($mysqli));

			mysqli_free_result($edit_score_response);			

		} else {

			// insert our record if it doesn't
			$add_score_query = "INSERT INTO Score (SongID, PlayerDigitsID, Score, ArchivedDate) VALUES ('" . $safe_song_id . ", " . $safe_player_digits_id . ", " . $safe_score . ", " . $safe_date . "')";
			$add_score_response = mysqli_query($mysqli, $add_score_query) or die(mysqli_error($mysqli));

			// get id
			$score_id = mysqli_insert_id($mysqli);
	
			// echo records
			echo "Score $score_id added.";
	
			mysqli_free_result($add_score_response);
		}

		mysqli_close($mysqli);
	}
		
?>
