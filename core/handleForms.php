<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

function validateFields($fields) {
	foreach ($fields as $field) {
		if (empty($field)) {
			return false;
		}
	}
	return true;
}

if (isset($_POST['insertCoachBtn'])) {
	$fields = [$_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = insertCoach($pdo, $_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editCoachBtn'])) {
	$fields = [$_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = updateCoach($pdo, $_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl'], $_GET['coach_id']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Edit failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deleteCoachBtn'])) {
	$query = deletecoach($pdo, $_GET['coach_id']);
	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertPlayerBtn'])) {
	$fields = [$_POST['playerName'], $_POST['email'], $_POST['preferredGame']];
	if (validateFields($fields)) {
		$query = insertPlayer($pdo, $_POST['playerName'], $_POST['email'], $_POST['preferredGame'], $_GET['coach_id']);
		if ($query) {
			header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editPlayerBtn'])) {
	$fields = [$_POST['playerName'], $_POST['email'], $_POST['preferredGame']];
	if (validateFields($fields)) {
		$query = updatePlayer($pdo, $_POST['playerName'], $_POST['email'], $_POST['preferredGame'], $_GET['player_id']);
		if ($query) {
			header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
		} else {
			echo "Update failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deletePlayerBtn'])) {
	$query = deleteplayer($pdo, $_GET['player_id']);
	if ($query) {
		header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
