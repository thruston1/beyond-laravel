/*
Name: 			Tables / Ajax - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#application_data');
		$table.dataTable({ destroy: true,});

	};

	$(function() {
		datatableInit();
	});
	

	$(document).on('click', '#syncptp', function (e) {
		$.ajax({
          url :"/c_data_application/syncPTP",
          type:"POST",
          dataType: 'html',
          success: function(result){
          	alert('synchronize PTP status success : '+result);  
          }                
     	})
    });

	// $(document).on('click', '#upload_task', function (e) {
	// 	e.preventDefault();
		
	// 	if($('#userfile').val().length > 0){
	// 		var data = new FormData($('#file')[0]);
	// 		var xhr, provider;

	// 		xhr = jQuery.ajaxSettings.xhr();			
			
	// 		$.ajax({
	// 			url: '/c_data_application/importcsv',
	// 			data: data,
	// 			cache: false,
	// 			contentType: false,
	// 			processData: false,
	// 			type: 'POST',
	// 			beforeSend: function() {
	// 				var percentComplete = '100%';
	// 				$('#progress').addClass('progress-striped');
	// 				$('#progress-bar').removeClass('progress-bar-info').addClass('progress-bar-warning');
	// 				$('#progress-bar').width(percentComplete);
	// 				$('#progress-bar').html('Processing...');
	// 			},
	// 			success: function(t){
	// 				var percentComplete = '100%';
	// 				$('#progress').removeClass('progress-striped');
	// 				$('#progress-bar').removeClass('progress-bar-warning').addClass('progress-bar-success');
	// 				$('#progress-bar').width(percentComplete);
	// 				$('#progress-bar').html('Uploaded');

	// 				var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
	// 				var notice = new PNotify({
	// 					title: 'Notification',
	// 					text: 'SUCCESS_UPLOAD '+ t + ' ROWS DATA',
	// 					type: 'success',
	// 					addclass: 'stack-bar-top',
	// 					stack: stack_bar_top,
	// 					width: "100%"
	// 				});
					
	// 				// if(t > 0){
	// 				// 	$('#application_data').dataTable( {
	// 				// 			"bDestroy": true,
	// 				// 			"ajax": {    
	// 				// 				"url": "/c_data_application/ajax_data",    
	// 				// 				"type": "POST",
	// 				// 				"data": {
	// 				// 			}
									
	// 				// 		}		
	// 				// 	});
	// 				// }
	// 			}
	// 		});
	// 	}
		
	// 	else{
	// 		var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
	// 		var notice = new PNotify({
	// 			title: 'Notification',
	// 			text: 'INPUT_ERROR_OR_EMPTY_FIELD',
	// 			type: 'error',
	// 			addclass: 'stack-bar-top',
	// 			stack: stack_bar_top,
	// 			width: "100%"
	// 		});
	// 	}	
		
	// });

	$(document).on('click', '#distribute_task', function (e) {
		e.preventDefault();		
			
		$.ajax({
			url: '/c_data_application/distribute_data',
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			beforeSend: function() {
				var percentComplete = '100%';
				$('#progress').addClass('progress-striped');
				$('#progress-bar').removeClass('progress-bar-info').addClass('progress-bar-warning');
				$('#progress-bar').width(percentComplete);
				$('#progress-bar').html('Processing...');
			},
			success: function(t){
				if(t > 1){
					var percentComplete = '100%';
					$('#progress').removeClass('progress-striped');
					$('#progress-bar').removeClass('progress-bar-warning').addClass('progress-bar-success');
					$('#progress-bar').width(percentComplete);
					$('#progress-bar').html('Distributed');

					var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
					var notice = new PNotify({
						title: 'Notification',
						text: 'SUCCESS_DISTRIBUTE',
						type: 'success',
						addclass: 'stack-bar-top',
						stack: stack_bar_top,
						width: "100%"
					});

					$('#application_data').dataTable( {
							"bDestroy": true,
							"ajax": {    
								"url": "/c_data_application/ajax_data",    
								"type": "POST",
								"data": {
							}
								
						}		
					});
				} else if(t == 0){
					var percentComplete = '100%';
					$('#progress').removeClass('progress-striped');
					$('#progress-bar').removeClass('progress-bar-warning').addClass('progress-bar-danger');
					$('#progress-bar').width(percentComplete);
					$('#progress-bar').html('Processed');

					var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
					var notice = new PNotify({
						title: 'Notification',
						text: 'FAILED_DISTRIBUTE',
						type: 'danger',
						addclass: 'stack-bar-top',
						stack: stack_bar_top,
						width: "100%"
					});
				}
			}
		});
	});
	

	// $(document).on('click', '#bucket_search', function (e) {
	// 	e.preventDefault();

	// 	var date = $("#dateBucket").val();

	// 	$('#application_data').dataTable( {
	// 			"bDestroy": true,
	// 			"ajax": {    
	// 				"url": "/c_data_application/ajax_data", 
	// 				"type": "POST",
	// 				"data": { date: date }
	// 		}
	// 	});
	// });
	
}).apply( this, [ jQuery ]);