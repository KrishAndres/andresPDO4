<?php  

function insertCoach($pdo, $coach_name, $email, $experience, $specialization ,$website_url) {

	$sql = "INSERT INTO coachTable (coach_name, email, experience, specialization, website_url, date_added) VALUES(?,?,?,?,?,NOW())";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_name, $email, $experience, $specialization, $website_url]);

	if ($executeQuery) {
		return true;
	}
}



function updateCoach($pdo, $coach_name, $email, $experience, $specialization, $website_url, $coach_id) {

	$sql = "UPDATE coachTable
				SET coach_name = ?,
					email = ?,
					experience = ?, 
					specialization =?,
					website_url = ?
				WHERE coach_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_name, $email, $experience,$specialization, $website_url, $coach_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deletecoach($pdo, $coach_id) {
	$deleteCoachPlayer = "DELETE FROM coachTable WHERE coach_id = ?";
	$deleteStmt = $pdo->prepare($deleteCoachPlayer);
	$executeDeleteQuery = $deleteStmt->execute([$coach_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM coachTable WHERE coach_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$coach_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCoach($pdo) {
	$sql = "SELECT * FROM coachTable";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCoachByID($pdo, $coach_id) {
	$sql = "SELECT * FROM coachTable WHERE coach_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getPlayersByCoach($pdo, $coach_id) {
	
	$sql = "SELECT 
				playerTable.player_id AS player_id,
				playerTable.player_name AS player_name,
				playerTable.email AS email,
				playerTable.preferred_game AS preferred_game,
				playerTable.date_added AS date_added,
				coachTable.coach_name AS coach_name
			FROM playerTable
			JOIN coachTable ON playerTable.coach_id = coachTable.coach_id
			WHERE playerTable.coach_id = ? 
			GROUP BY playerTable.player_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertPlayer($pdo, $player_name, $email, $preferred_game, $coach_id) {
	$sql = "INSERT INTO playerTable (player_name, email, preferred_game, coach_id, date_added) VALUES (?,?,?,?,NOW())";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_name, $email, $preferred_game, $coach_id]);
	if ($executeQuery) {
		return true;
	}

}

function getPlayerByID($pdo, $player_id) {
	$sql = "SELECT 
				playerTable.player_id AS player_id,
				playerTable.player_name AS player_name,
				playerTable.email AS email,
				playerTable.preferred_game AS preferred_game,
				playerTable.date_added AS date_added,
				coachTable.coach_name AS coach_name
			FROM playerTable
			JOIN coachTable ON playerTable.coach_id = coachTable.coach_id
			WHERE playerTable.player_id  = ? 
			GROUP BY playerTable.player_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updatePlayer($pdo, $player_name, $email, $preferred_game, $player_id) {
	$sql = "UPDATE playerTable
			SET player_name = ?,
				email = ?,
				preferred_game = ?
			WHERE player_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_name, $email, $preferred_game, $player_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteplayer($pdo, $player_id) {
	$sql = "DELETE FROM playerTable WHERE player_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
