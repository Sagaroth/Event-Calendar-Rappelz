<?php require_once 'header.php' ?>
    <body>
        <!-- Page Content -->
        <div class="container">
		
            <!-- MENU -->
			<?php require_once 'menu.php' ?>
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
										<div class="barcontainer"> <!-- Password strengh bar -->
											<div class="bar"></div>
										</div>
									</div>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
				                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				                        </div>
				                        <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNUP_BISPASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="confirmpassword" id="confirmpassword"></br>	                        
									</div>
                                </div>
                                <div class="modal-footer">
									<input type="hidden" name="csrf_token" value="<?php echo $token; /*Passing token inside POST*/ ?>">
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
									<input type="hidden" name="csrf_token" value="<?php echo $token; /*Passing token inside POST*/ ?>">
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
										listOrga($bdd, $lang);
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
											listDona($bdd, $lang);
										?>
									</div>
								</div>
								</div>
						</div>
					</div>
				</div>
                <!-- ./DONATORS MODAL -->
				
                <!-- ADD EVENT MODAL-->
				<?php 
				if(isSet($_SESSION['user_session']))
				{
				?>
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
                                        <input type="text" name="organisateur" class="form-control" value='<?php echo "$userlogged";?>' id="organisateur" placeholder="<?php echo $userlogged; ?>" readonly>
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
                                        <select name="color" class="form-control" id="color" required>
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
				<?php
				}
				else
				{
				noConnectedModal($lang);
				}
				?>
                <!-- ./ADD EVENT MODAL -->
				<!-- EDIT EVENT MODAL -->
				<?php 
				if(isSet($_SESSION['user_session']))
				{
				?>
                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
							 <form class="form-horizontal" method="POST" id="edit-form">
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
                                        <input type="text" name="organisateur" class="form-control" value='<?php echo "$userlogged";?>' id="organisateur" placeholder='<?php echo "$userlogged";?>' readonly>
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
                                            <option style="color:#f83f90;" value="#f83f90">Lamia</option>
                                            <option style="color:#43aaf8;" value="#43aaf8">Abhuva</option>
                                            <option style="color:#f14afb;" value="#f14afb">Les deux serveurs</option>
                                            <option style="color:#66bb6a;" value="#66bb6a">Autre</option>
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
                                    <button type="submit" class="btn btn-success" id="btnjson">Go !</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				<?php
				}
				else
				{
				?>
				<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                               <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;<?php echo $lang['EVENTSHOW_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="title" class="form-control" id="title" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                        </div>
                                        <textarea name="description" class="form-control" id="description" placeholder="<?php echo $lang['EVENTSHOW_TEXTDES']; ?>" rows="5" readonly disabled="true"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <input type="text" name="organisateur" class="form-control" id="organisateur" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
                                        </div>
                                        <input type="text" name="orgaavailable" class="form-dispo" id="orgaavailable" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
                                        </div>
                                        <select name="color" class="form-control" id="color" readonly disabled="true">
                                            <option value=""><?php echo $lang['EVENTMOD_SELECTEVENTLOCA']; ?></option>
                                            <option style="color:#f83f90;" value="#f83f90">Lamia</option>
                                            <option style="color:#43aaf8;" value="#43aaf8">Abhuva</option>
                                            <option style="color:#f14afb;" value="#f14afb">Les deux serveurs</option>
                                            <option style="color:#66bb6a;" value="#66bb6a">Autre</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-gifts"></i></span>
                                        </div>
                                        <input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="<?php $lang['EVENTMOD_TEXTDONA']; ?>" readonly>
                                    </div>
                                </div>
						</div>
                    </div>
                </div>
				<?php
				}
				?>
				
				<div class="modal fade" id="ModalNotOwner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                               <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;<?php echo $lang['EVENTSHOW_TITLE']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" name="title" class="form-control" id="title" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                        </div>
                                        <textarea name="description" class="form-control" id="description" placeholder="<?php echo $lang['EVENTSHOW_TEXTDES']; ?>" rows="5" readonly disabled="true"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <input type="text" name="organisateur" class="form-control" id="organisateur" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
                                        </div>
                                        <input type="text" name="orgaavailable" class="form-dispo" id="orgaavailable" readonly disabled="true">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
                                        </div>
                                        <select name="color" class="form-control" id="color" readonly disabled="true">
                                            <option value=""><?php echo $lang['EVENTMOD_SELECTEVENTLOCA']; ?></option>
                                            <option style="color:#f83f90;" value="#f83f90">Lamia</option>
                                            <option style="color:#43aaf8;" value="#43aaf8">Abhuva</option>
                                            <option style="color:#f14afb;" value="#f14afb">Les deux serveurs</option>
                                            <option style="color:#66bb6a;" value="#66bb6a">Autre</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-gifts"></i></span>
                                        </div>
                                        <input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="<?php $lang['EVENTMOD_TEXTDONA']; ?>" readonly>
                                    </div>
                                </div>
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
				        right: 'listMonth,month' // other buttons are irrelevent for this calendar (no need for a full day or hours per day), stay simple
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
			
			        eventRender: function(event, element, view) {
				        element.bind('click', function() {
						if (event.url) {
					        $('#ModalNotOwner #id').val(event.id);
					        $('#ModalNotOwner #title').val(event.title);
					        $('#ModalNotOwner #description').val(event.description);
					        $('#ModalNotOwner #organisateur').val(event.organisateur);
					        $('#ModalNotOwner #orgaavailable').val(event.orgaavailable);
					        $('#ModalNotOwner #donator').val(event.donator);
					        $('#ModalNotOwner #color').val(event.color);
							$('#ModalNotOwner').modal('show');
							return false;
						}
						else {
							$('#ModalEdit #id').val(event.id);
					        $('#ModalEdit #title').val(event.title);
					        $('#ModalEdit #description').val(event.description);
					        $('#ModalEdit #organisateur').val(event.organisateur);
					        $('#ModalEdit #orgaavailable').val(event.orgaavailable);
					        $('#ModalEdit #donator').val(event.donator);
					        $('#ModalEdit #color').val(event.color);
					        $('#ModalEdit').modal('show');
						}
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
		{<?php if ($userlogged == $organisateur || (isSet($isadmin))){ ?> 
							id: '<?php echo $event['id']; ?>',
					        title: '<?php echo $title; ?>',
					        description: "<?php echo $description; ?>",
					        organisateur: '<?php echo $organisateur; ?>',
					        orgaavailable: '<?php echo $orgaavailable; ?>',
					        donator: '<?php echo $donator; ?>',
					        start: '<?php echo $start; ?>',
					        end: '<?php echo $end; ?>',
					        color: '<?php echo $event['color']; ?>',
							<?php }else{ ?> 
							id: '<?php echo $event['id']; ?>',
					        title: '<?php echo $title; ?>',
					        description: "<?php echo $description; ?>",
					        organisateur: '<?php echo $organisateur; ?>',
					        orgaavailable: '<?php echo $orgaavailable; ?>',
					        donator: '<?php echo $donator; ?>',
					        start: '<?php echo $start; ?>',
					        end: '<?php echo $end; ?>',
					        color: '<?php echo $event['color']; ?>',
							editable : false,
							url: '#',<?php } ?> 
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
			         url: 'event/editEventDate.php',
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
                $('.fc-button.fc-listMonth-button, .fc-button.fc-month-button').text('');
                $('.fc-button.fc-listMonth-button, .fc-button.fc-month-button').append('<span class="fa fa-list-ul"></span>');
                $('.fc-button.fc-month-button').addClass('d-none');
				$('.fc-button.fc-listMonth-button, .fc-button.fc-month-button').click(function(){
					$('.fc-button.fc-listMonth-button, .fc-button.fc-month-button').toggleClass('d-none');
				});

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
                    return $.get('/formAutoComplete.php', { query: query }, function (data) {
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
			minlength: 6,
			maxlength: 60
			},
			description: {
			minlength: 20,
			maxlength: 5000
			},
			organisateur: {
			required: true,
			minlength: 4,
			maxlength: 20
			},
			orgaavailable: {
			minlength: 4,
			maxlength: 20
			},
			donator: {
			minlength: 4,
			maxlength: 20
			},
			color: { 
			required: true 
			},
			},
			   messages:
			{
            title: {
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>",
            minlength: "<?php printf ($lang['EVENTADD_TITLELENGHT_ERROR'], 6); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 60); ?>"
            },
            description: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 20); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 5000); ?>"
            },
            organisateur: {
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>",
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            orgaavailable: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            donator: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            color: { 
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>" 
            },
			   },
			submitHandler: submitForm 
			   });  
		 
			/* handle form submit */
			function submitForm() {  
			var data = $("#add-form").serialize();    
			$.ajax({    
			type : 'POST',
			url  : 'event/addEvent.php',
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
			
			/* handle form validation */  
			$("#edit-form").validate({
			  rules:
			{
			title: {
			required: true,
			minlength: 6,
			maxlength: 60
			},
			description: {
			minlength: 20,
			maxlength: 5000
			},
			organisateur: {
			required: true,
			minlength: 4,
			maxlength: 20
			},
			orgaavailable: {
			minlength: 4,
			maxlength: 20
			},
			donator: {
			minlength: 4,
			maxlength: 20
			},
			color: { 
			required: true 
			},
			},
			   messages:
			{
            title: {
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>",
            minlength: "<?php printf ($lang['EVENTADD_TITLELENGHT_ERROR'], 6); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 60); ?>"
            },
            description: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 20); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 5000); ?>"
            },
            organisateur: {
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>",
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            orgaavailable: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            donator: {
            minlength: "<?php printf ($lang['FIELD_MINLENGHT_ERROR'], 4); ?>",
            maxlength: "<?php printf($lang['FIELD_MAXLENGHT_ERROR'], 20); ?>"
            },
            color: { 
            required: "<?php echo $lang['FIELD_REQUIRED']; ?>" 
            },
			   },
			submitHandler: submitForm 
			   });  
			
			/* handle form submit */
			function submitForm() {  
			var data = $("#edit-form").serialize();    
			$.ajax({    
			type : 'POST',
			url  : 'event/editEvent.php',
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
			
	$(document).ready(function()
	{
		$('.signup').hide();
		$('#signup').click(function()
		{
			$('.login').slideUp('slow');
			$('.signup').slideDown('slow');
		});
		$('#login').click(function()
		{
			$('.signup').slideUp('slow');
			$('.login').slideDown('slow');
		});	
	});
        </script>
    </body>
<?php require_once 'footer.php' ?>