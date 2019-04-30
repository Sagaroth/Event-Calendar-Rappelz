<?php
function listOrga($bdd, $lang){
	$orgasql = "SELECT organisateur, COUNT(*) as count FROM events GROUP BY organisateur";   
	$orgareq = $bdd->prepare($orgasql);                                     
	$orgareq->execute();                                        
		while($eventrow = $orgareq->fetch(PDO::FETCH_ASSOC)) {             
		if ($eventrow['count'] == "1")
		{$eventorgaas[] = '<b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENT_STRING'];}
		elseif ($eventrow['count'] >= "3" && $eventrow['count'] < "5")
		{$eventorgaas[] = '<i class="fa fa-trophy" style="color:#CD7F32"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];}
		elseif ($eventrow['count'] >= "5" && $eventrow['count'] < "10")
		{$eventorgaas[] = '<i class="fa fa-trophy" style="color:silver"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];}
		elseif ($eventrow['count'] >= "10")
		{$eventorgaas[] = '<i class="fa fa-trophy" style="color:gold"></i> <b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];}
		else
		{$eventorgaas[] = '<b>'.$eventrow['organisateur'] . '</b> - ' . $eventrow['count'] . ' ' . $lang['ORGANIZERS_EVENTS_STRING'];}
		}
			if (empty($eventorgaas)) {
			$eventimploded = "<div class='alert alert-warning'>".$lang['ORGANIZERS_NO_EVENT']."</div>";
			}							
			else {
			$eventimploded = implode('</br>',$eventorgaas); 
			}	
			echo $eventimploded;
}

function listDona($bdd, $lang){
	$donasql = "SELECT donator, COUNT(*) as count FROM events GROUP BY donator";                                  
	$donareq = $bdd->prepare($donasql);                                     
	$donareq->execute();                                        
		while($eventrowdona = $donareq->fetch(PDO::FETCH_ASSOC)) {       
		$eventdonas[] = $eventrowdona['donator'];}
		if (empty($eventdonas)) {
		$eventimexplodedona = "<div class='alert alert-warning'>".$lang['DONATORS_NO_EVENT']."</div>";}							
		else {
		$eventimplodedona = implode("</br>", $eventdonas);
		$eventexlodedona = explode(",", $eventimplodedona);
		$eventimplodedonabr = implode("</br>", $eventexlodedona);
		$eventimexplodedona = implode('</br>', array_unique(explode('</br>', $eventimplodedonabr)));}	
		echo '<b>'.$eventimexplodedona. '</b>';
}

function blueDotAdmin($isadmin, $lang){
	if(isSet($isadmin)){
	echo '&nbsp;&nbsp;<i class="fas fa-certificate" style="color:#58C4F0" title='.$lang['GENERAL_ADMIN'].'></i>';}
}

function noConnectedModal($lang, $token){?>
	<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo $lang['NOCONNECTED_TITLE']; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
			<div class="modal-register">
            <div class="modal-body">
				<p><?php echo $lang['NOCONNECTED_DESCRIPTION']; ?></p>
					<form name="myform" method="post" action="">
					<center><button type="button" class="btn btn-success" name="option" id="login"> <span class="option"><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;<?php echo $lang['MENU_SUBLOGIN']; ?></span></button>&nbsp;&nbsp;<button type="button" class="btn btn-success" name="option" id="signup"><span class="option"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $lang['MENU_SUBREGISTRATION']; ?></span></button></center>
					</form>
					<br />
					<!-- Login form -->
					<div class="login">
					<form class="form-horizontal" id="login-bis" name="login-bis" role="form" style="display: block;" method="post">
						<div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo $lang['SIGNIN_TITLE']; ?></h4>
                        </div>
						<div class="modal-login">
                        <div class="modal-body">
						<p><?php echo $lang['SIGNIN_DESCRIPTION']; ?></p>
						<div class="alert alert-danger" role="alert" id="errorbis" style="display: none;"><?php echo $lang['SIGNIN_BADLOGIN']; ?></div>
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
							<button type="submit" class="btn btn-success" name="login-submit" id="login-submit-bis" tabindex="4">
							<span class="spinner"><i class="icon-spin icon-refresh" id="spinner"></i></span><?php echo $lang['SIGNIN_VALIDATION']; ?>
							</button>
						</div>
						</div>							
					</form>
					</div>
					<!-- end Login form -->
					<!-- Signup form -->
					<div class="signup">
                    <form class="form-horizontal" method="POST" id="sign-bis">
                        <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo $lang['SIGNUP_TITLE']; ?></h4>
                        </div>
						<div class="modal-sign">
                        <div class="modal-body">
                        <p><?php echo $lang['SIGNUP_DESCRIPTION']; ?></p>
                        <div id="errorsignbis"></div>
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
				                <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNUP_PASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="password" id="passwordbis"></br>
			                </div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
				                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				                </div>
				                <input type="password" class="form-control" placeholder="<?php echo $lang['SIGNUP_BISPASSWORD'];?>" aria-label="pwd" aria-describedby="basic-addon1" name="confirmpassword" id="confirmpasswordbis"></br>
			                	<div class="barcontainer"> <!-- Password strengh bar -->
									<div class="bar"></div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
							<input type="hidden" name="csrf_token" value="<?php echo $token; /*Passing token inside POST*/ ?>">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['GENERAL_CLOSE']; ?></button>
                            <button type="submit" class="btn btn-success" name="btn-save" id="btn-sign-bis"><?php echo $lang['SIGNUP_REGISTER']; ?></button>
                        </div>
						</div>
                    </form>
					</div> 		
			</div>
            </div>
            </div>
		</div>
	</div>
<?php
}

?>