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
  $("#add-form").validate({
      rules:
   {
   title: {
      required: true,
   minlength: 3
   },
    },
       messages:
    {
            title: ('&nbsp; Veuillez entrer un titre</div>'),
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
	window.location = "";
    },
    });
    return false;
  }
});