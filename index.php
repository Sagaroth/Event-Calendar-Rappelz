<?php
require_once('bdd.php');


$sql = "SELECT id, title, description, organisateur, start, end, color FROM events ";
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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

<div class="container">
	
	<div class="register_container">
	<form class="form-signin" method="post" id="register-form">
	<h2 class="form-signin-heading">User Registration Form</h2><hr />
	<div id="error">
	</div>
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" />
	</div>
	<div class="form-group">
	<input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
	<span id="check-e"></span>
	</div>
	<div class="form-group">
	<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
	</div>
	<div class="form-group">
	<input type="password" class="form-control" placeholder="Retype Password" name="cpassword" id="cpassword" />
	</div>
	<hr />
	<div class="form-group">
	<button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
	<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
	</button> 
	</div>  
	</form>
	</div>
</div>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>FullCalendar PHP MySQL</h1>
                <p class="lead">Complétez avec des chemins d'accès prédéfinis que vous n'aurez pas à modifier !</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Ajouter un événement</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
				  </div>
				  <!--<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					  <input type="textarea" name="description" class="form-control" id="description" placeholder="Description" rows="3" cols="10">
					</div>
				  </div>-->
				  <div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					<textarea  name="description" class="form-control" id="description" placeholder="Description" rows="5"></textarea>
				    </div>
				  </div>
				  <div class="form-group">
					<label for="organisateur" class="col-sm-2 control-label">Organisateur</label>
					<div class="col-sm-10">
					  <input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="Organisateur">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Lieu de l'événement</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
									  <option value="">Sélectionnez</option>
						  <option style="color:#42a5f5;" value="#42a5f5">Lamia</option>
						  <option style="color:#f44336;" value="#f44336">Abhuva</option>
						  <option style="color:#66bb6a;" value="#66bb6a">Les deux serveurs</option>						  
						  <option style="color:#5e35b1;" value="#5e35b1">Autre</option>
						  <!--<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rouge</option>
						  <option style="color:#000;" value="#000">&#9724; Noir</option>-->						  
						</select>
					</div>
				  </div>
				  <!--<div class="form-group">
					<label for="start" class="col-sm-2 control-label">Date de début</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>-->
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Date de début</label>
					<div class="col-sm-10">
					  <!--<input type="text" name="start" class="form_datetime" id="start" readonly>-->
					  <input type="text" name="start" class="form_datetime" id="start" value="" readonly>
					</div>
				  </div>


				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">Date de fin</label>
					<div class="col-sm-10">
					  <!--<input type="text" name="end" class="form-control" id="end" >-->
					  <input type="text" name="end" class="form_datetime" id="end" value="" readonly>
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Go !</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Modifier l'événement</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
				  </div>
				  <!--<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					  <input type="textarea" name="description" class="form-control" id="description" placeholder="Description" rows="3" cols="10">
					</div>
				  </div>-->
				  <div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					<textarea  name="description" class="form-control" id="description" placeholder="Description" rows="5"></textarea>
				    </div>
				  </div>
				  <div class="form-group">
					<label for="description" class="col-sm-2 control-label">Organisateur</label>
					<div class="col-sm-10">
					  <input type="text" name="organisateur" class="form-control" id="organisateur" placeholder="Organisateur">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Lieu de l'événement</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
									  <option value="">Sélectionnez</option>
						  <option style="color:#42a5f5;" value="#42a5f5">Lamia</option>
						  <option style="color:#f44336;" value="#f44336">Abhuva</option>
						  <option style="color:#66bb6a;" value="#66bb6a">Les deux serveurs</option>						  
						  <option style="color:#5e35b1;" value="#5e35b1">Autre</option>
						  <!--<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rouge</option>
						  <option style="color:#000;" value="#000">&#9724; Noir</option>-->					  
						</select>
					</div>
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
				<button type="submit" class="btn btn-primary">Go !</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <!--<script src="js/jquery.js"></script>-->
	<script src='js/jquery.qtip.min.js'></script>
	<script type="text/javascript" src="script/validation.min.js"></script>
	<script type="text/javascript" src="script/register.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!--<script src="js/bootstrap.min.js"></script>-->

	
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
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			element.qtip({
                  content: "<b>" + event.title + "</b>" + "<br> <br>" + event.description,
              });
			event.description = event.description.replace(/ [ \r\n]+/gm, "\n");
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

			?>
							{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $title; ?>',
					description: "<?php echo $description; ?>",
					organisateur: '<?php echo $organisateur; ?>',
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

</body>

</html>
