<?php
/*	Rappelz Event Calendar  - Make events with players.>
    Copyright (C) <2019>  <History of Rappelz>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.*/

// Conexion a la base
include_once("../connect/db_cls_connect.php"); //Include connection file.
editEventDate($link);

function editEventDate($link) { //Create edit event date function.
	if (isSet($_SESSION['user_session'])){
	if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

		$handle = $link->prepare('UPDATE events SET start = :start, end = :end WHERE id = :id');
		$handle->bindValue(':id', $id, PDO::PARAM_INT);
		$handle->bindValue(':start', $start, PDO::PARAM_STR);
		$handle->bindValue(':end', $end, PDO::PARAM_STR);		
		$handle->execute();
		die('OK');
}
}
}
?>
