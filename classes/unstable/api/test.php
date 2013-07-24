<?php
	echo json_encode( array( "hello" => "world", "dal" => $DAL->query("SELECT (30+12) as MeaningOfLife, NOW() as Timestamp")));
?>
