<?php

	// Get all of something
	function getAll($tbl) {
		include('connect.php');

		$queryAll = "SELECT * FROM {$tbl}";
		$runAll = mysqli_query($link, $queryAll);
		if($runAll) {
			return $runAll;
		} else {
			$error = "There was a hole here. It's gone now.";
			return $error;
		}

		mysqli_close($link);
	}

	function getSingle($tbl, $col, $id) {
		include('connect.php');

		$querySingle = "SELECT * FROM {$tbl} WHERE {$col} = {$id}";
		$runSingle = mysqli_query($link, $querySingle);
		if($runSingle) {
			return $runSingle;
		} else {
			$error = "The door that wakes in darkness, opening into nightmares.";
			return $error;
		}

		mysqli_close($link);
	}

	function filterType($tbl, $tbl2, $tbl3, $col, $col2, $col3, $filter) {
		include('connect.php');

		$queryFilter = "SELECT * FROM {$tbl}, {$tbl2}, {$tbl3} WHERE {$tbl}.{$col} = {$tbl3}.{$col} AND {$tbl2}.{$col2} = {$tbl3}.{$col2} AND {$tbl2}.{$col3} = '{$filter}'";
		// echo $queryFilter;
		$runFilter = mysqli_query($link, $queryFilter);
		if($runFilter) {
			return $runFilter;
		} else {
			$error = "Monsters...? They look like monsters to you?";
			return $error;
		}

		mysqli_close($link);
	}

?>