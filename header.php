<?php
    session_start();
    header('Cache-control: private'); // IE 6 FIX
	
	//Generate Token from 16 random bytes string and convert to HEX. 
	//Token need to be generated at each load of the page so as to obtain a unique and non-duplicable value.
	$token = bin2hex(random_bytes(16));
	$_SESSION['csrf_token'] = $token; //Store token into SESSION
	
    if(isSet($_GET['lang']))
    {
        $lang = $_GET['lang'];
        // Register the session and set the cookie
        $_SESSION['lang'] = $lang;
        setcookie("lang", $lang, time() + (3600 * 24 * 30));
    }
    else if(isSet($_SESSION['lang']))
    {
        $lang = $_SESSION['lang'];
    }
    else if(isSet($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
    }
    else
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
    switch ($lang) {
          case 'fr':
          //French
          $lang_file = 'lang.fr.php';
          break;
        // Default English if other language than FR detected
          default:
          $lang_file = 'lang.en.php';
    }
    include_once 'languages/'.$lang_file;
	if(isSet($_SESSION['user_session']))
	{
		$userlogged = ucfirst($_SESSION['user_session']);
	}else{
		$userlogged = NULL;
	}
	if(isSet($_SESSION['isadmin']))
	{
		$isadmin = $_SESSION['isadmin'];
	}else{
		$isadmin = NULL;
	}
?>
<!--	<Rappelz Event Calendar  - Make events with players.>
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
    along with this program.  If not, see <https://www.gnu.org/licenses/>. -->


<?php
require_once('connect/bdd.php');
require_once('function.php');
//include_once 'language.php';

$sql = "SELECT id, title, description, organisateur, orgaavailable, donator, start, end, color FROM events ";
$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="<?php echo $lang['HTML_LANG']; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="author" content="HOR">

        <title><?php echo $lang['PAGE_TITLE']; ?></title>
	    
	    <!-- CSS REFERENCES-->

		    <!-- Bootstrap -->
    	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
			<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
            <link href='css/typeaheadjs.css' rel='stylesheet' />
            <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

            <!-- Dropzone -->    
        	<link rel="stylesheet" type="text/css" href="dropzone/dropzone.css" />

            <!-- jQuery -->
	        <link href='css/jquery.qtip.min.css' rel='stylesheet' />

            <!-- FullCalendar -->
	        <link href='css/fullcalendar.css' rel='stylesheet' />

            <!-- Menu -->
            <link href='css/menu.css' rel='stylesheet' />

            <!-- Site -->
            <link href="css/style.css" rel="stylesheet" />

	    <!-- END CSS REFERENCES-->
    
	    <!-- FONT REFERENCES -->
    
    	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css?family=Rubik:300,400&amp;subset=latin-ext" rel="stylesheet">

	    <!-- END FONT REFERENCES -->

        <!-- JS REFERENCES -->

            <!-- jQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
			<script src='js/jquery.qtip.min.js'></script>
	        <script src="js/validation.min.js"></script>
			<script scr="js/jquery.ui.touch.js"></script>
			
            <!-- Poppers -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

            <!-- Bootstrap -->    
    	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    	    <script src="js/custom_tags_input.js"></script>
	        <script src="js/bootstrap-datetimepicker.js"></script>
	        <script src="js/locales/bootstrap-datetimepicker.fr.js"></script>

            <!-- Dropzone -->
            <script type="text/javascript" src="dropzone/dropzone.js"></script>
        	<script type="text/javascript" src="js/upload.js"></script>

            <!-- Moment -->
	        <script src='js/moment.min.js'></script>

            <!-- FullCalendar -->
	        <script src='js/fullcalendar/fullcalendar.min.js'></script>
	        <script src='js/fullcalendar/fullcalendar.js'></script>
	        <script src='js/fullcalendar/locale/<?php echo $lang['HTML_LANGALT']; ?>.js'></script>

            <!-- Menu -->
            <script src="js/classie.js"></script>
            <script src="js/menu.js"></script>

            <!-- Site -->
    	    <script type="text/javascript" src="js/register.js"></script>
			<script type="text/javascript" src="js/sign.js"></script>
			<script type="text/javascript" src="js/login.js"></script>
			<script type="text/javascript" src="js/loginbis.js"></script>
			<script type="text/javascript" src="js/signbis.js"></script>

        <!-- END JS REFERENCES -->

    </head>