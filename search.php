<?php
/*  Rappelz Event Calendar  - Make events with players.>
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
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
include_once("connect/db_cls_connect.php"); //Include connection file.

	$array = array();
	$responseCode = 500;
	
	/* si la requête est bien en Ajax et la méthode en GET ... */
	if((strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') && ($_SERVER['REQUEST_METHOD'] == 'GET')){
		/* on récupère le terme et on le duplique en terme en transformant les espaces en tirets et tirets en espaces (au cas ou) */
		$q = str_replace("''","'",urldecode($_REQUEST['q']));
		$q = strtolower(str_replace("'","''",$q));
		$qTiret = str_replace(' ','-',$q);
		$qSpace = str_replace('-',' ',$q);
		
		$array = array();
		
		/* creation de la requête SQL */
		$query=$link->query('SELECT ts.id, ts.user, ts.server FROM usersavalaibles ts WHERE (ts.user LIKE \'%'.$q.'%\' OR ts.user LIKE \'%'.$qTiret.'%\' OR ts.user LIKE \'%'.$qSpace.'%\' OR ts.server LIKE \'%'.$q.'%\') ORDER BY ts.user ASC');
		$query->setFetchMode(PDO::FETCH_OBJ);
		
		/* remplissage du tableau avec les termes récupéré en requete (ou non) */
		while($q = $query->fetch()){
			$user = utf8_encode($q->user);
			$server = utf8_encode($q->server);
			$array[] = array(
					'id' => $q->id,
					'label' => $user.' ('.$server.')',
					'value' => $user.' ('.$server.')',
			);
		}
		$query->closeCursor();
				
		//die(print_r($array));
		
		$responseCode = 200;
	}
	
	/* génération réponse JSON */
	http_response_code($responseCode);
	header('Content-Type: application/json');
	echo json_encode($array);
?>