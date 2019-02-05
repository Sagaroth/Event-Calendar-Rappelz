<?php
require_once('bdd.php');


$sql = "SELECT id, title, description, organisateur, orgaavailable, donator, start, end, color FROM events ";
$sql = $sql;
$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accueil</title>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
	<script src="js/custom_tags_input.js"></script>
	
	<link href='css/typeaheadjs.css' rel='stylesheet' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	
	
    <!-- Bootstrap Core CSS -->
	<!-- NavBar -->
	<!--<link rel="stylesheet" href="css/docs.css">-->
	<link rel="stylesheet" href="css/navbar-fixed-right.min.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<link rel="stylesheet" href="css/navbar-fixed-left.min.css">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

	<!-- Qtip -->
	<link href='css/jquery.qtip.min.css' rel='stylesheet' />

    <!-- Custom CSS -->
    <style>
    body {
		background-color: #eee;
    }
	#calendar {
		#max-width: 800px;
		padding: 15px 15px 10px 15px;
		border-radius: 6px;
		box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
		background-color: #FFFFFF;
		color: #252422;
		margin-bottom: 20px;
		position: relative;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>



</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-left">
    <span class="navbar-brand">Event Calendar Rappelz</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	
		<form class="form-signin" method="post" id="register-form">
        <ul class="navbar-nav">
		    <span class="navbar-text">Je veux organiser un event</span>
			<span class="navbar-text">En remplissant le formulaire ci-dessous, vous pouvez vous inscrire sur la liste des personnes disponibles pour organiser un event</span>
			<div id="error">
			</div>
            <li class="nav-item">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1"><i class="fas fa-user-ninja"></i></span>
				</div>
				<input type="text" class="form-control" placeholder="Pseudo" aria-label="Pseudo" aria-describedby="basic-addon1" name="user_name" id="user_name">
			</div>
            </li>
            <li class="nav-item">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
				<label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
				</div>
				<select class="custom-select" id="inputGroupSelect01" name="user_server">
				<option selected>Sélectionnez...</option>
				<option value="Lamia">Lamia</option>
				<option value="Abhuva">Abhuva</option>
				<option value="Les deux serveurs">Les deux serveurs</option>
				<option value="Autre">Autre</option>
				</select>
			</div>
            </li>
			<li class="nav-item">
			<center><button class="btn btn-success" type="submit" name="btn-save" id="btn-submit">M'inscrire</button></center>
            </li>
        </ul>
		</form>
		
    </div>
</nav>


    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Ajouter un événement</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">

					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
					</div>
					<input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
					
					<div class="input-group mb-3">
				    <div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-text-height"></i></span>
					</div>
					<textarea name="description" class="form-control" id="description" placeholder="Description" rows="5"></textarea>
					</div>
				  
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
					</div>
					<input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="Organisateur">
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
					</div>
					<input type="text" name="orgaavailable" class="form-dispo" style="margin:0px auto;width:300px;" placeholder="Rechercher une personne disponible pour vous aider à organiser l'événement">
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-gifts"></i></span>
					</div>
					<input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="Donateur(s) - Séparer chaque entrée par une virgule (5 max)">
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
					</div>
					  <select name="color" class="form-control" id="color">
						  <option value="">Lieu de l'événement</option>
						  <option style="color:#42a5f5;" value="#42a5f5">Lamia</option>
						  <option style="color:#f44336;" value="#f44336">Abhuva</option>
						  <option style="color:#66bb6a;" value="#66bb6a">Les deux serveurs</option>						  
						  <option style="color:#5e35b1;" value="#5e35b1">Autre</option>				  
						</select>
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Date et heure de début</span>
					</div>
					<input type="text" name="start" class="form_datetime" id="start" value="" readonly>
					</div>

					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Date et heure de fin</span>
					</div>
					<input type="text" name="end" class="form_datetime" id="end" value="" readonly>
					</div>

			  </div>
			  
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-success">Go !</button>
			  </div>
			  </div>
			</form>
			</div>
			</div>
			</div>

		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="far fa-edit"></i>&nbsp;&nbsp;Modifier l'événement</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
					</div>
					<input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
					
					<div class="input-group mb-3">
				    <div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-text-height"></i></span>
					</div>
					<textarea name="description" class="form-control" id="description" placeholder="Description" rows="5"></textarea>
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
					</div>
					<input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="Organisateur">
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1"><i class="fas fa-user-plus"></i></span>
					</div>
					<input type="text" name="orgaavailable" class="form-dispo" id="orgaavailable" placeholder="Rechercher une personne disponible pour vous aider à organiser l'événement">
					</div>
					
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt"></i></label>
					</div>
					  <select name="color" class="form-control" id="color">
						  <option value="">Lieu de l'événement</option>
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
					<input type="text" name="donator" class="form-control" id="donator" data-role="tagsinput" placeholder="Donateur(s) - Séparer chaque entrée par une virgule (5 max)">
					</div>
					
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Supprimer cet événement</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-success">Go !</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>		
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
	<script src='js/jquery.qtip.min.js'></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<script type="text/javascript" src="js/register.js"></script>
    <!-- Bootstrap Core JavaScript -->

	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/fr.js'></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<script src="js/locales/bootstrap-datetimepicker.fr.js"></script>
	
	
	<script>

	$(document).ready(function() {

	   var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
				
		$('#calendar').fullCalendar({
			defaultView: 'agendaWeek',
			nowIndicator: 'true',
			header: {
				language: 'fr',
				left: 'title',
				center: 'month,agendaWeek,agendaDay',
				right: 'prev,next today',
			},
			views: {
			month: {columnFormat: 'dddd'}, 
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
			//event.description = event.description.replace(/ [ \r\n]+/gm, "\n");
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
		
	});

    $(".form_datetime").datetimepicker({
		language: 'fr',
        format: "yyyy-mm-dd hh:ii:00",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
    });
</script>

<script type="text/javascript">
	$('input.form-dispo').typeahead({
	    source:  function (query, process) {
        return $.get('/FormAutoComplete.php', { query: query }, function (data) {
        		console.log(data);
        		data = $.parseJSON(data);
	            return process(data);
	        });
	    }
	});
</script>

<script type="text/javascript">
$('#donator').tagsinput({
confirmKeys: [13, 44],
maxTags: 5
});
</script>
</body>
</html>
