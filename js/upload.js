$(document).ready(function(){
	$(".dropzone").dropzone({
	  url: 'addEvent.php',
	  /*width: '100%',*/
	  /*height: 300,*/ 
	  progressBarWidth: '100%',
	  maxFileSize: '5MB',
	})
});