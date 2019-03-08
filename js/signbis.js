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
  $("#sign-bis").validate({
      rules:
   {
   identifier: {
      required: true,
   minlength: 4
   },
  passwordbis: {
	  required: true,
	minlength: 8
   },
  confirmpasswordbis: {
	  required: true,
      equalTo: "#passwordbis"
   },
   },
       messages:
    {
            identifier: ('&nbsp; Veuillez entrer un nom d\'utilisateur</div>'),
			passwordbis: ('&nbsp; Un mot de passe de 8 caractères minimum est requis</div>'),
			confirmpasswordbis: ('&nbsp; Les mots de passe ne sont pas les mêmes</div>'),
       },
    submitHandler: submitForm 
       });  
 
    /* handle form submit */
    function submitForm() {  
    var data = $("#sign-bis").serialize();    
    $.ajax({    
    type : 'POST',
    url  : 'sign.php',
    data : data,
    beforeSend: function() { 
     $("#errorsignbis").fadeOut();
     $("#btn-sign-bis").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Vérification ...');
    },
    success :  function(response) {      
        if(response==1){         
			 $("#errorsignbis").fadeIn(1000, function(){
			   $("#errorsignbis").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Ce compte existe déjà !</div>');           
			   $("#btn-sign-bis").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Créer mon compte');          
			 });                    
        } else if(response=="registered"){         
			 $("#btn-sign-bis").html('<img src="ajax-loader.gif" /> &nbsp; Entrée dans le monde de Gaïa ...');
			 setTimeout('$(".modal-sign").load("welcomesign.php");',3000);         

        } else {          
         	$("#errorsignbis").fadeIn(1000, function(){           
      			$("#errorsignbis").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');           
         		$("#btn-sign-bis").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; M\'inscrire');         
         	});           
       	}
        }
    });
    return false;
  }
});