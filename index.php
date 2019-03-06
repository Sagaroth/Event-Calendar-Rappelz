<?php
    session_start();
    header('Cache-control: private'); // IE 6 FIX
    if(isSet($_GET['lang']))
    {
        $lang = $_GET['lang'];
        // register the session and set the cookie
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
		$userlogged = ucfirst($_SESSION['user_session']);
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
require_once('bdd.php');
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
            <script src='js/jquery.qtip.min.js'></script>
	        <script type="text/javascript" src="js/validation.min.js"></script>

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
    	    <script type="text/javascript" src="js/addevent.js"></script>

        <!-- END JS REFERENCES -->

    </head>

    <body>
        <!-- Page Content -->
        <div class="container">
		
            <!-- MENU -->
		    <ul id="gn-menu" class="gn-menu-main">
			    <li class="gn-trigger">
				    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
				    <nav class="gn-menu-wrapper">
					    <div class="gn-scroller">
						    <ul class="gn-menu">
							
							    <?php 
									if(isSet($_SESSION['user_session']))
									{
								?>
								<li>
								    <a>
                                        <span class="fa fa-home"></span>
                                        <?php echo $lang['GENERAL_WELCOME'].$userlogged.' !';?>	
                                    </a>
								<ul class="gn-submenu">
                                <li><a href="response.php?action=logout">
                                        <span class="fa fa-sign-out-alt"></span>
                                        <?php echo $lang['MENU_LOGOUT'];?>
                                    </a>
                                </li>
								</ul>
							    </li>
								<?php
									}
									else
									{
								?>
								<li>
								    <a>
                                        <span class="fa fa-user-circle"></span>
										<?php echo $lang['MENU_REGISTRATION'].' '.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>
                                    </a>
								<ul class="gn-submenu">
                                <li><a onclick="$('#ModalSignup').modal('show');">
                                        <span class="fa fa-user-plus"></span>
                                        <?php echo $lang['MENU_SUBREGISTRATION'];?>
                                    </a>
                                </li>
                                <li><a onclick="$('#ModalSignin').modal('show');">
										<span class="fa fa-sign-in-alt"></span>
                                        <?php echo $lang['MENU_SUBLOGIN'];?>
                                    </a>
                                </li>
								</ul>
							    </li>
									<?php
									}
									?>
								<li>
								    <a onclick="$('#ModalRegister').modal('show');">
                                        <span class="fa fa-hands-helping"></span>
                                        <?php echo $lang['MENU_AVAILABLE'];?>
                                    </a>
							    </li>
							    <li>
                                    <a onclick="$('#ModalOrganizers').modal('show');">
                                        <span class="fa fa-users"></span>
                                        <?php echo $lang['MENU_ORGANIZERS']; ?>
                                    </a>
                                </li>
							    <li>
                                    <a>
                                        <span class="fa fa-comments"></span>
                                        <?php echo $lang['MENU_CHATBOX']; ?>
                                    </a>
                                </li>
							    <li>
                                    <a onclick="$('#ModalDonators').modal('show');">
                                        <span class="fa fa-trophy"></span>
                                        <?php echo $lang['MENU_DONATORS']; ?>
                                    </a>
                                </li>						
                                <li>
								    <a>
                                        <span class="fa fa-cogs"></span>
                                        <?php echo $lang['MENU_SETTINGS']; ?>
                                    </a>
								</li>
								<li>
                                    <a>
                                        <span class="fa fa-globe"></span>
                                        <?php echo $lang['MENU_LANGUAGES']; ?> -&nbsp; <a href="index.php?lang=fr"><span class="flag-icon flag-icon-fr"></span></a>&nbsp; <a href="index.php?lang=en"><span class="flag-icon flag-icon-us"></span><span class="flag-icon flag-icon-gb"></span></a>
                                    </a>
                                </li>
							    </li>
							    <li>
                                    <a>
                                        <span class="fa fa-info-circle"></span>
                                        <?php echo $lang['MENU_ABOUT']; ?>
                                    </a>
                                </li>	
						    </ul>
					    </div><!-- /gn-scroller -->
				    </nav>
			    </li>
		        <li><a class="gn-menu-close"><span class="fa fa-times"></span></a></li>
		    </ul>
            <!-- ./MENU -->

		    <!-- HEAD -->
		    <header class="page-header text-center">
			    <h1>RAPPELZ Events</h1>
                <span><?php echo $lang['HEADER_TITLE']; ?></span>
		    </header>

		    <div class="row text-center">
			    <div class="col-md-12">
				    <p><?php echo $lang['HEADING']; ?></p>
			    </div>
		    </div>
		    <!-- ./HEAD -->

            <!-- CALENDAR -->
            <div class="row">
                <div class="col-lg-12 text-center nopadding">
                    <div id="calendar" class="col-centered">
                    </div>
                </div>
            </div>
            <!-- /.CALENDAR -->
		
            <!-- MODALS -->
            
                <!-- SIGNUP MODAL -->
				<div class="modal fade" id="ModalSignup" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" id="sign-form">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $lang['SIGNUP_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
								<div class="modal-sign">
                                <div class="modal-body">
                                    <p>
                                        <?php echo $lang['SIGNUP_DESCRIPTION']; ?>
                                    </p>

                                    <div id="error"></div>
			                        <div class="input-group mb-3">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-ninja"></i></span>
				                        </div>
				                        <input type="text" class="form-control" placeholder="<?php echo $lang['SIGNUP_ID'];?>" aria-label="id" aria-describedby="basic-addon1" name="identifier" id="identifier"></br>
			                        </div>
			                        <div class="input-group mb-3">
										<div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				                        </div>
				                        <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNUP_PASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="password" id="password"></br>
			                        </div>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				                        </div>
				                        <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNUP_BISPASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="confirmpassword" id="confirmpassword"></br>
			                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn-save" id="btn-sign"><?php echo $lang['SIGNUP_REGISTER']; ?></button>
                                </div>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
				<!-- ./SIGNUP MODAL -->
				
				<!-- SIGNIN MODAL -->
				<div class="modal fade" id="ModalSignin" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
							<form class="form-horizontal" id="login-form" name="login_form" role="form" style="display: block;" method="post">
								<div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $lang['SIGNIN_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
								<div class="modal-login">
                                <div class="modal-body">
                                    <p>
                                        <?php echo $lang['SIGNIN_DESCRIPTION']; ?>
                                    </p>
									<div class="alert alert-danger" role="alert" id="errorlogin" style="display: none;"><?php echo $lang['SIGNIN_BADLOGIN']; ?></div>

			                        <div class="input-group mb-3">
										<div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-ninja"></i></span>
				                        </div>
				                        <input type="text" class="form-control" placeholder="<?php echo $lang['SIGNIN_ID'];?>" aria-label="id" aria-describedby="basic-addon1" name="username" id="username"></br>
			                        </div>
			                        <div class="input-group mb-3">
										<div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				                        </div>
				                        <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNIN_PASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="password" id="password"></br>
			                        </div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
									<button type="submit" class="btn btn-success" name="login-submit" id="login-submit" tabindex="4">
									<span class="spinner"><i class="icon-spin icon-refresh" id="spinner"></i></span><?php echo $lang['SIGNIN_VALIDATION']; ?>
									</button>
								</div>
								</div>							
							</form>	   
                        </div>	
                    </div>
                </div>
				<!-- ./SIGNIN MODAL -->
				
                <!-- REGISTER MODAL -->
                <div class="modal fade" id="ModalRegister" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" id="register-form">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $lang['REGISTER_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
								<div class="modal-register">
                                <div class="modal-body">
                                    <p>
                                        <?php echo $lang['REGISTER_DESCRIPTION']; ?>
                                    </p>

                                    <div id="error"></div>
			                        <div class="input-group mb-3">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-ninja"></i></span>
				                        </div>
				                        <input type="text" class="form-control" placeholder="Pseudo" aria-label="Pseudo" aria-describedby="basic-addon1" name="user_name" id="user_name"></br>
			                        </div>
			                        <div class="input-group mb-3">
				                        <div class="input-group-prepend">
				                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
				                        </div>
				                        <select class="custom-select" id="inputGroupSelect01" name="user_server">
				                            <option><?php echo $lang['REGISTER_SELECT']; ?></option>
				                            <option value="Lamia">Lamia</option>
				                            <option value="Abhuva">Abhuva</option>
				                            <option value="Les deux serveurs">Les deux serveurs</option>
				                            <option value="Autre">Autre</option>
				                        </select>
			                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
                                    <button type="submit" class="btn btn-success" name="btn-save" id="btn-submit"><?php echo $lang['GENERAL_REGISTER']; ?></button>
                                </div>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./REGISTER MODAL -->

				<!-- ORGANIZERS MODAL -->
                <div class="modal fade" id="ModalOrganizers" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $lang['ORGANIZERS_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
								<div class="modal-organizers">
                                <div class="modal-body">
                                    <p>
                                        <?php echo $lang['ORGANIZERS_DESCRIPTION']; ?>	
                                    </p>
									<div id="listorga">
										<?php
										$orgasql = "SELECT organisateur, COUNT(*) as count FROM events GROUP BY organisateur";                                  
										$orgareq = $bdd->prepare($orgasql);                                     
										$orgareq->execute();                                        
										while($eventrow = $orgareq->fetch(PDO::FETCH_ASSOC)) {             
												if ($eventrow['count'] == "1")
												{	$eventorgaas[] = '<b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENT_STRING'];                                     
												}
												 elseif ($eventrow['count'] >= "3" && $eventrow['count'] < "5")
												{	$eventorgaas[] = '<i class="fa fa-trophy" style="color:#CD7F32"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];     
												}
												elseif ($eventrow['count'] >= "5" && $eventrow['count'] < "10")
												{	$eventorgaas[] = '<i class="fa fa-trophy" style="color:silver"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];     
												}
												elseif ($eventrow['count'] >= "10")
												{	$eventorgaas[] = '<i class="fa fa-trophy" style="color:gold"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];     
												}
												 else
												{	$eventorgaas[] = '<b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];     
												}
										}
										if (empty($eventorgaas)) {
											$eventimploded = "<div class='alert alert-warning'>".$lang['ORGANIZERS_NO_EVENT']."</div>";
										}							
										else {
											$eventimploded = implode('</br>',$eventorgaas); 
										}	
										echo $eventimploded;
										?>
									</div>
								</div>
								</div>
						</div>
					</div>
				</div>
                <!-- ./ORGANIZERS MODAL -->
				
				<!-- DONATORS MODAL -->
                <div class="modal fade" id="ModalDonators" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $lang['DONATORS_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
								<div class="modal-organizers">
                                <div class="modal-body">
                                    <p>
                                        <?php echo $lang['DONATORS_DESCRIPTION']; ?>	
                                    </p>
									<div id="listdona">
										<?php
										$donasql = "SELECT donator, COUNT(*) as count FROM events GROUP BY donator";                                  
										$donareq = $bdd->prepare($donasql);                                     
										$donareq->execute();                                        
										while($eventrowdona = $donareq->fetch(PDO::FETCH_ASSOC)) {       
												$eventdonas[] = $eventrowdona['donator'];
										}
										if (empty($eventdonas)) {
											$eventimexplodedona = "<div class='alert alert-warning'>".$lang['DONATORS_NO_EVENT']."</div>";
										}							
										else {
											$eventimplodedona = implode("</br>", $eventdonas);
											$eventexlodedona = explode(",", $eventimplodedona);
											$eventimplodedonabr = implode("</br>", $eventexlodedona);
											$eventimexplodedona = implode('</br>', array_unique(explode('</br>', $eventimplodedonabr)));
										}	
										echo '<b>'.$eventimexplodedona. '</b>';
										?>
									</div>
								</div>
								</div>
						</div>
					</div>
				</div>
                <!-- ./DONATORS MODAL -->
				
                <!-- ADD EVENT MODAL -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" id="add-form">

                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><i class="far fa-plus-square"></i>&nbsp;&nbsp;<?php echo $lang['EVENTADD_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo $lang['EVENTADD_TEXTTITLE']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                        </div>
                                        <textarea name="description" class="form-control" id="description" placeholder="<?php echo $lang['EVENTADD_TEXTDES']; ?>" rows="5"></textarea>
                                    </div>
                                    			  	    
                                    <div class="input-group mb-3">
				  	                    <div class="dropzone" id="myDropzoneElementId">
										</div>
				  	                </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="<?php echo $lang['EVENTADD_TEXTORGA']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
                                        </div>
                                        <input type="text" name="orgaavailable" class="form-dispo" style="margin:0px auto;width:300px;" placeholder="<?php echo $lang['EVENTADD_TEXTSEARCH']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-gifts"></i></span>
                                        </div>
                                        <input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="<?php echo $lang['EVENTADD_TEXTDONA']; ?>">
										<small id="donatorlabel" class="form-text text-muted">
<?php echo $lang['EVENTADD_LABELDONA']; ?>										</small>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
                                        </div>
                                        <select name="color" class="form-control" id="color">
                                            <option value=""><?php echo $lang['EVENTADD_SELECTEVENTLOCA']; ?></option>
                                            <option style="color:#f83f90;" value="#f83f90">Lamia</option>
                                            <option style="color:#43aaf8;" value="#43aaf8">Abhuva</option>
                                            <option style="color:#f14afb;" value="#f14afb">Les deux serveurs</option>
                                            <option style="color:#66bb6a;" value="#66bb6a">Autre</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $lang['EVENTADD_DATESTART']; ?></span>
                                        </div>
                                        <input type="text" name="start" class="form_datetime" id="start" value="" readonly>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $lang['EVENTADD_DATEEND']; ?></span>
                                        </div>
                                        <input type="text" name="end" class="form_datetime" id="end" value="" readonly>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
									<button type="submit" class="btn btn-success" id="btn_calendar">Go !</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./ADD EVENT MODAL -->
                
                <!-- EDIT EVENT MODAL -->
                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="editEvent.php">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><i class="far fa-edit"></i>&nbsp;&nbsp;<?php echo $lang['EVENTMOD_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo $lang['EVENTMOD_TEXTTITLE']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                        </div>
                                        <textarea name="description" class="form-control" id="description" placeholder="<?php echo $lang['EVENTMOD_TEXTDES']; ?>" rows="5"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="<?php echo $lang['EVENTMOD_TEXTORGA']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
                                        </div>
                                        <input type="text" name="orgaavailable" class="form-dispo" id="orgaavailable" placeholder="<?php echo $lang['EVENTMOD_TEXTSEARCH']; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
                                        </div>
                                        <select name="color" class="form-control" id="color">
                                            <option value=""><?php echo $lang['EVENTMOD_SELECTEVENTLOCA']; ?></option>
                                            <option style="color:#42a5f5;" value="#42a5f5">Lamia</option>
                                            <option style="color:#f44336;" value="#f44336">Abhuva</option>
                                            <option style="color:#66bb6a;" value="#66bb6a">Les deux serveurs</option>
                                            <option style="color:#5e35b1;" value="#5e35b1">Autre</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-gifts"></i></span>
                                        </div>
                                        <input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="<?php $lang['EVENTMOD_TEXTDONA']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label class="text-danger">
                                                    <input type="checkbox" name="delete"> <?php echo $lang['EVENTMOD_DELETE']; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" class="form-control" id="id">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
                                    <button type="submit" class="btn btn-success">Go !</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./EDIT EVENT MODAL -->

            <!-- ./MODALS -->
        </div>

	    <script type="text/javascript">
	        $(document).ready(function() {

	           var date = new Date();
               var yyyy = date.getFullYear().toString();
               var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
               var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
				
		        $('#calendar').fullCalendar({
			        defaultView: 'month',
			        nowIndicator: 'true',
                    titleFormat: 'MMMM',
			        header: {
				        language: '<?php echo $lang['HTML_LANG']; ?>',
				        left: 'prev,next,today',
				        center: 'title',
				        right: 'listMonth,month,agendaWeek,agendaDay' // other buttons are irrelevent for this calendar (no need for a full day or hours per day), stay simple
			        },    
                    buttonText: {
                        listMonth: 'L'
                    },
			        views: {
			            month: {columnFormat: 'dd'}, 
			            week: {columnFormat: 'DD/MM'}, 
			            day: {columnFormat: 'dddd' }
			        },
			        defaultDate: yyyy+"-"+mm+"-"+dd,
			        editable: true,
			        eventLimit: true, // allow "more" link when too many events
			        selectable: true,
			        selectHelper: true,
			        select: function(start, end) {
				        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				        $('#ModalAdd').modal('show');
			        },
                // dayNamesShort: ['DIM', 'LUN', 'MAR', 'MER', 'JEU', 'VEN', 'SAM'],
			
			        eventRender: function(event, element) {
				        element.bind('click', function() {
					        $('#ModalEdit #id').val(event.id);
					        $('#ModalEdit #title').val(event.title);
					        $('#ModalEdit #description').val(event.description);
					        $('#ModalEdit #organisateur').val(event.organisateur);
					        $('#ModalEdit #orgaavailable').val(event.orgaavailable);
					        $('#ModalEdit #donator').val(event.donator);
					        $('#ModalEdit #color').val(event.color);
					        $('#ModalEdit').modal('show');
				        });
			        element.qtip({
                          content: "<b>" + event.title + "</b>" + "<br> <br>" + event.description,
                      });
			        },

			        eventDrop: function(event, delta, revertFunc) { // si changement de position

				        edit(event);

			        },
			        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				        edit(event);

			        },
					
			        events: [
			        <?php foreach($events as $event): 
                              
                              $start = explode(" ", $event['start']);
                              $end = explode(" ", $event['end']);
                              if($start[1] == '00:00:00'){
                                  $start = $start[0];
                              }else{
                                  $start = $event['start'];
                              }
                              if($end[1] == '00:00:00'){
                                  $end = $end[0];
                              }else{
                                  $end = $event['end'];
                              }
                              
                              $title = addslashes($event['title']);
                              $description = addslashes($event['description']);
                              $organisateur = addslashes($event['organisateur']);
                              $orgaavailable = addslashes($event['orgaavailable']);
                              $donator = addslashes($event['donator']);

                    ?>
					    {
					        id: '<?php echo $event['id']; ?>',
					        title: '<?php echo $title; ?>',
					        description: "<?php echo $description; ?>",
					        organisateur: '<?php echo $organisateur; ?>',
					        orgaavailable: '<?php echo $orgaavailable; ?>',
					        donator: '<?php echo $donator; ?>',
					        start: '<?php echo $start; ?>',
					        end: '<?php echo $end; ?>',
					        color: '<?php echo $event['color']; ?>',
				        },
			        <?php endforeach; ?>
			        ]

		        });
		
		        function edit(event){
			        start = event.start.format('YYYY-MM-DD HH:mm:ss');
			        if(event.end){
				        end = event.end.format('YYYY-MM-DD HH:mm:ss');
			        }else{
				        end = start;
			        }
			
			        id =  event.id;
			
			        Event = [];
			        Event[0] = id;
			        Event[1] = start;
			        Event[2] = end;
			
			        $.ajax({
			         url: 'editEventDate.php',
			         type: "POST",
			         data: {Event:Event},
			         success: function(rep) {
					        if(rep == 'OK'){
						        alert('L\'événement a été sauvegardé correctement');
					        }else{
						        alert('Il n\'a pas pu être sauvegardé. Essayez encore une fois.'); 
					        }
				        }
			        });
		        }
		

		
                // Change list button appearance
                $('.fc-button.fc-listMonth-button').text('');
                $('.fc-button.fc-listMonth-button').append('<span class="fa fa-list-ul"></span>');

                // Create menu
                new gnMenu(document.getElementById('gn-menu'));
            
                // Init datepicker
                $(".form_datetime").datetimepicker({
		            language: '<?php echo $lang['HTML_LANGALT']; ?>',
                    format: "yyyy-mm-dd hh:ii:00",
                    autoclose: true,
                    todayBtn: true,
                    pickerPosition: "bottom-left",
                });

                // Init autocomplete
	            $('input.form-dispo').typeahead({
	                source:  function (query, process) {
                    return $.get('/FormAutoComplete.php', { query: query }, function (data) {
        		            console.log(data);
        		            data = $.parseJSON(data);
	                        return process(data);
	                    });
	                }
                });
            
                $('#donator').tagsinput({
                    confirmKeys: [13, 44],
                    maxTags: 5
                });

	
	        });

			Dropzone.autoDiscover = false;
			Dropzone.options.myDropzoneElementId = { 
			maxFilesize: 5,
			parallelUploads: 5,
			maxFiles: 5,
			acceptedFiles: 'image/*',
			dictDefaultMessage: "<?php echo $lang['EVENTADD_TEXTDROP']; ?>",
			dictInvalidFileType : "Ce type de fichier n'est pas accepté",
			addRemoveLinks: true,  
			dictRemoveFile : "Supprimer le fichier",
			dictMaxFilesExceeded : "La limite autorisées de nombre d'images  a été atteinte",
			dictFileTooBig : "Le fichier fait plus de 5Mo",
			dictCancelUpload : "Annuler",
			renameFile: function (file) {
			let newName = new Date().getTime() + '_' + file.name;
			return newName;
			},
			autoProcessQueue : false,
			init: function (e) {
			var myDropzone = this;
				$('#btn_calendar').on("click", function() {
            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
			});
			}
			};
			
			/* handle form validation */  
			$("#add-form").validate({
			  rules:
			{
			title: {
			required: true,
			minlength: 6
			},
			organisateur: {
			required: true,
			minlength: 4
			},
			},
			   messages:
			{
			title: {
			required: "<?php echo $lang['EVENTADD_NOTITLE_ERROR']; ?>",
			minlength: "<?php echo $lang['EVENTADD_TITLELENGHT_ERROR']; ?>"
			},
			organisateur: {
			required: "<?php echo $lang['EVENTADD_NOORGA_ERROR']; ?>",
			minlength: "<?php echo $lang['EVENTADD_ORGALENGHT_ERROR']; ?>"
			},
			   },
			submitHandler: submitForm 
			   });  
		 
			/* handle form submit */
			function submitForm() {  
			var data = $("#add-form").serialize();    
			$.ajax({    
			type : 'POST',
			url  : 'addEvent.php',
			data : data,
			beforeSend: function() { 
			 $("#error").fadeOut();
			 $("#btn_calendar").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Vérification ...');
			setTimeout(function(){
			window.location.reload(true);
			},100);     
			},
			});
			return false;
			}
        </script>
    </body>
</html>