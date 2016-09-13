<?php
    session_start();

	// mode is set, see if it is for updateFilters
	if (isset($_POST["mode"])) {
		if ($_POST["mode"] === "updateFilters") {
			foreach ($_POST as $key => $value) {
				$_SESSION[$key] = $value;
			}
		}

		echo '<script>var filters = ';
		echo json_encode($_POST, JSON_HEX_TAG);
		echo ';</script>';
	}

	include("../private/helpers.php");
	render("map.php");
	
?>