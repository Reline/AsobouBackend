<?php
header("Content-Type: text/html; charset=utf-8");
include 'common.php';
    if($_POST) {
        
        // check for required fields
        if(!$_POST['UserName'] || !$_POST['PhoneNumber'] || !$_POST['DigitsID']) {
            echo "Check required fields";
            exit();
        }
        
        //connect to DB
        connectToDB();
        
        //get input & clean them
        $safe_username = mysqli_real_escape_string($mysqli, $_POST['UserName']);
        //I obsviously dgaf
        $safe_phone_number = mysqli_real_escape_string($mysqli, $_POST['PhoneNumber']);
        $safe_digitsID = mysqli_real_escape_string($mysqli, $_POST['DigitsID']);
       
        // get id to see if record already exists
        $get_digits_id_query = "SELECT ID FROM Player WHERE DigitsID = '" . $safe_digitsID . "'";
        $get_digits_id_response = mysqli_query($mysqli, $get_digits_id_query) or die(mysqli_error($mysqli));

        // check if record exists
        if(mysql_num_rows($get_digits_id_response) != 0) {
            // update
            $edit_player_query = "UPDATE Player SET UserName = '" . $safe_username . "', PhoneNumber = '" . $safe_phone_number . "' WHERE DigitsID = '" . $safe_digitsID . "'";
            $edit_player_response = mysqli_query($mysqli, $edit_player_query) or die(mysqli_error($mysqli));

            mysqli_free_result($edit_player_response);

        } else {
            //insert into db
            $add_player_query = "INSERT INTO Player (UserName, PhoneNumber, DigitsID) values ('" . $safe_username . "', '" . $safe_phone_number . "', '" . $safe_digitsID . "')";
            
            $add_player_response = mysqli_query($mysqli, $add_player_query) or die(mysqli_error($mysqli));
            
            //get user ID
            $player_id = mysqli_insert_id($mysqli);
            
            //echo records added
            echo "Player $player_id added.";
            
            mysqli_free_result($add_player_response);
        }
        // don't duplicate code, sheesh
        mysqli_close($mysqli);
    }

?>
