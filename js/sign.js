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
    along with this program.  If not, see <https://www.gnu.org/licenses/>. */

$('document').ready(function() {   
  /* handle form validation */  
  $("#sign-form").validate({
      rules:
   {
   identifier: {
      required: true,
   minlength: 4
   },
  password: {
	  required: true,
	minlength: 8
   },
  confirmpassword: {
	  required: true,
      equalTo: "#password"
   },
   },
       messages:
    {
            identifier: ('&nbsp; Veuillez entrer un nom d\'utilisateur</div>'),
			password: ('&nbsp; Un mot de passe de 8 caractères minimum est requis</div>'),
			confirmpassword: ('&nbsp; Les mots de passe ne sont pas les mêmes</div>'),
       },
    submitHandler: submitForm 
       });  
 
    /* handle form submit */
    function submitForm() {  
    var data = $("#sign-form").serialize();    
    $.ajax({    
    type : 'POST',
    url  : 'account/sign.php',
    data : data,
    beforeSend: function() { 
     $("#error").fadeOut();
     $("#btn-sign").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Vérification ...');
    },
    success :  function(response) {      
        if(response==1){         
			 $("#error").fadeIn(1000, function(){
			   $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Ce compte existe déjà !</div>');           
			   $("#btn-sign").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Créer mon compte');          
			 });                    
        } else if(response=="registered"){         
			 $("#btn-sign").html('<img src="ajax-loader.gif" /> &nbsp; Entrée dans le monde de Gaïa ...');
			 setTimeout('$(".modal-sign").load("welcomesign.php");',2000);         

        } else {          
         	$("#error").fadeIn(1000, function(){           
      			$("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; Il y a eu un problème lors de votre inscription, nous vous invitons à réessayer !</div>');           
         		$("#btn-sign").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; M\'inscrire');         
         	});           
       	}
        }
    });
    return false;
  }
  $(function(){
    $('#password').keyup(function(){
        
        var pass_val = $('#password').val();
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        
        var okRegex = new RegExp("(?=.{6,}).*", "g");

        if(okRegex.test(pass_val) === false){
            $('.bar').addClass('weak');
        }else if(strongRegex.test(pass_val)){
            $('.bar').addClass('strong');
        }else if(mediumRegex.test(pass_val)){
            $('.bar').addClass('medium');
        }else{
            $('.bar').addClass('medium');
        }

        
    });
    $('#password').blur(function(){
        $('.bar').removeClass('medium');
        $('.bar').removeClass('weak');
        $('.bar').removeClass('strong');
    });
	});
});