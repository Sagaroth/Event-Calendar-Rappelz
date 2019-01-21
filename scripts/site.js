/**
 * Get the current language from url
 **/
function getCurrentLanguage() {
    var defaultLanguage = 'fr';
    var name = 'lang'.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(location.href);
    if (results == null)
        return defaultLanguage;
    else
        return results[1];
}

/**
 * Create an event using the form
 **/
function createEvent() {

	var startDate = $('input[name="eventDate"]').data('daterangepicker').startDate;
	var endDate = $('input[name="eventDate"]').data('daterangepicker').endDate;

	$('#calendar').fullCalendar('renderEvent',
        {
            title: $('#eventName').val(),
            start: startDate.format('YYYY-MM-DD') + 'T' + startDate.format('HH:mm:ss'),
            end: endDate.format('YYYY-MM-DD') + 'T' + endDate.format('HH:mm:ss'),
            description: '<strong>Organisateur:</strong> ' + $('#eventCreator').val() + '<br/>' + '<strong>Type d\'event: </strong>' + $('#eventType').select2('data')[0].text + '<br/>' + '<strong>Description: </strong>' + $('#eventDescription').val()
        },
        true // make the event "stick"
    );

    /**
     * TOSTORE ajax call to store event in DB
     */
    /*
	jQuery.post(
        "event/new" // your url
        , { // re-use event's data
            title: title,
            start: start,
            end: end
        }
    );
    */
    $('#create-event-modal').modal('hide');
	return false;
}

/**
 * Create an event using the form
 **/
function createEventType() {

	var currentRegion = getCurrentLanguage();

	// add to event ideas
	var row = '<tr><td>' + $('#eventTypeName').val() + ($('#eventTypeCreator').val() ? (' <i>(créé par ' + $('#eventTypeCreator').val() + ')</i>') : '' ) + '</td><td id=\'event_' + currentRegion + '_id_' + Object.keys(eventTypeDict[currentRegion]).length + '\'>' + $('#eventTypeDescription').val() + '</td></tr>';
	$('#eventSample tbody').append(row);

	// add to event type list
	eventTypeDict[currentRegion].push({id: Object.keys(eventTypeDict[currentRegion]).length, text: $('#eventTypeName').val()});


	// TOSTORE (!HTML/JS)

    $('#create-event-type-modal').modal('hide');
	return false;
}

/**
 * Validate the creation form
 **/
function validateEventCreationForm() {
	try {
		
		// TODO maybe find an other validation plugin, because there is no locale option (seems it uses the loaded localization js)
		$( "#create-event-form" ).validate( {
			rules: {
				eventName: {
					required: true,
					minlength: 5
				},
				eventCreator: {
					required: true,
					minlength: 3
				},
				eventType: "required",
				eventDescription: {
					required: true,
					minlength: 20
				},
				eventDate: "required"
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-md-10" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-md-10" ).addClass( "has-success" ).removeClass( "has-error" );
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				// Add the `help-block` class to the error element
				error.addClass( "help-block" );

				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
			submitHandler: function(form) {
				createEvent();
			}
		} );
	}
	catch(e) {
		console.log("OH MY GOOOOOD !! AN ERROR !!  YOU NOOOB !!! " + e)
	}
}

/**
 * Validate the creation form (type)
 **/
function validateEventTypeCreationForm() {
	try {
		
		$( "#create-event-type-form" ).validate( {
			rules: {
				eventTypeName: {
					required: true,
					minlength: 5
				},
				eventTypeDescription: {
					required: true,
					minlength: 20
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-md-10" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-md-10" ).addClass( "has-success" ).removeClass( "has-error" );
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				// Add the `help-block` class to the error element
				error.addClass( "help-block" );

				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
			submitHandler: function(form) {
				createEventType();
			}
		} );
	}
	catch(e) {
		console.log("OH MY GOOOOOD !! AN ERROR !!  YOU NOOOB !!! " + e)
	}
}


/**
 * Initilize event type form
 **/
function initEventTypeForm() {

	// clear form
	$('#eventTypeName').val('');
	$('#eventTypeCreator').val('');
	$('#eventTypeDescription').val('');

	$('#create-event-type-modal').modal()
}

/**
 * Initilize event form
 **/
function initEventForm() {

	// clear form
	$('#eventName').val('');
	$('#eventType').val('').trigger('change');
	$('#eventDescription').val('');

	$('#create-event-modal').modal()
}