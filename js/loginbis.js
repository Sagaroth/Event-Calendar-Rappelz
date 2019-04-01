$(document).ready(function(){
	/* handling form validation */
	$("#login-bis").validate({
		rules: {
			password: {
				required: true,
				minlength: 8
			},
			username: {
				required: true,
				minlength: 4
			},
		},
		messages: {
			password:{
			  required: "&nbsp; </div>",
			  minlength: "&nbsp; Le mot de passe indiqué doit faire plus de 8 caractères</div>"
			 },
			username: "&nbsp; Veuillez indiquer votre identifiant</div>",
		},
		submitHandler: submitForm	
	});	

	/* Handling login functionality */
	function submitForm() {		
		var data = $("#login-bis").serialize();
		$.ajax({				
			type : 'POST',
			url  : 'account/response.php?action=login',
			data : data,
			beforeSend: function(){	
				$("#errorbis").fadeOut();
				$("#login-submit-bis").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Vérification ...');
			},
			success : function(response){			
				if($.trim(response) === "1"){
					console.log('dddd');									
					$("#login-submit-bis").html('Connexion en cours');
					setTimeout(' window.location.href = "index.php"; ',1000);
				} else {									
					$("#errorbis").fadeIn(1000, function(){						
					});
				}
			}
		});
		return false;
	}

	/* Handling login functionality */
	function logout() {
		console.log('fdfdf');
		$.ajax({				
			type : 'POST',
			url  : 'account/response.php?action=logout',
			data : data,
			success : function(response){
				window.location.href = "/index.php";
			}
		});
		return false;
	}   
});