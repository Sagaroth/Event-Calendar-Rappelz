<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'dba_calendar_event', '55npMvH9oJhuRvW4');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
