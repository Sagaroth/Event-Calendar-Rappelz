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
                                        <?php echo $lang['GENERAL_WELCOME'].$userlogged.' !'; blueDotAdmin($isadmin, $lang);?>	
                                    </a>
								<ul class="gn-submenu">
                                <li><a href="account/response.php?action=logout">
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
										<?php echo $lang['MENU_REGISTRATION'];?>
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