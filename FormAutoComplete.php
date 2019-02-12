<?php
/*<!--	<Rappelz Event Calendar  - Make events with players.>
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
    along with this program.  If not, see <https://www.gnu.org/licenses/>. -->*/
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";
$mysqli = new mysqli($servername, $username, $password, $dbname);
	
$sql = "SELECT Concat(user, ' - ', server) AS fulldetail FROM users 
		WHERE user LIKE '%".$_GET['query']."%'
		LIMIT 15"; 
$result = $mysqli->query($sql);
	

$jsonuser = [];
while($row = $result->fetch_assoc()){
    $jsonuser[] = $row['fulldetail'];
}

echo json_encode($jsonuser);