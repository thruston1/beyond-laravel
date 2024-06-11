$(function(){
	
	$("#CustMessage").hide();
	$("#saveMessage").hide();
    $("#customerMessage").prop("disabled", false);
	
	var state = "ONCALL";
	var uid = $("#uid").val();
	var fName = $("#fName").val();
	var lkpNo = $("#lkpNo").val();
	var seqNo = $("#seqNo").val();
	var contractNo = $("#contractNo").val();
	var kodeCabang = $("#kodeCabang").val();

	$("#number1").click(function(){
		
		var number1 = $("#filtered1").val();
		var value1 = "number="+ number1 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
		$("#number1").addClass( "grey", function(){
			
			$("#number1").prop('disabled', true);
			/*$('#state1').prop('disabled',true);*/
			$('#state1').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number1").removeClass( "grey", function(){
					
					$("#number1").prop('disabled', false);
					/*$('#state1').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/doAuth/createCall",
				data: value1,
				cache: false,
				success: function(){
					/*$('#state1').prop('disabled',false);*/
					showButton();
				}
			});
		}
		
		createCall();
	});
	
	$("#number2").click(function(){
		
		var number2 = $("#filtered2").val();
		var value2 = "number="+ number2 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
		$("#number2").addClass( "grey", function(){
			
			$("#number2").prop('disabled', true);
			/*$('#state2').prop('disabled',true);*/
			$('#state2').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number2").removeClass( "grey", function(){
					
					$("#number2").prop('disabled', false);
					/*$('#state2').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/doAuth/createCall",
				data: value2,
				cache: false,
				success: function(){
					/*$('#state2').prop('disabled',false);*/
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number3").click(function(){
		
		var number3 = $("#filtered3").val();
		var value3 = "number="+ number3 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
		$("#number3").addClass( "grey", function(){
			
			$("#number3").prop('disabled', true);
			/*$('#state3').prop('disabled',true);*/
			$('#state3').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number3").removeClass( "grey", function(){
					
					$("#number3").prop('disabled', false);
					/*$('#state3').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/doAuth/createCall",
				data: value3,
				cache: false,
				success: function(){
					/*$('#state3').prop('disabled',false);*/
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number4").click(function(){
		
		var number4 = $("#filtered4").val();
		var value4 = "number="+ number4 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
		$("#number4").addClass( "grey", function(){
			
			$("#number4").prop('disabled', true);
			/*$('#state4').prop('disabled',true);*/
			$('#state4').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number4").removeClass( "grey", function(){
					
					$("#number4").prop('disabled', false);
					/*$('#state4').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/doAuth/createCall",
				data: value4,
				cache: false,
				success: function(){
					/*$('#state4').prop('disabled',false);*/
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number5").click(function(){
		
		var number5 = $("#filtered5").val();
		var value5 = "number="+ number5 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
		$("#number5").addClass( "grey", function(){
			
			$("#number5").prop('disabled', true);
			/*$('#state5').prop('disabled',true);*/
			$('#state5').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number5").removeClass( "grey", function(){
					
					$("#number5").prop('disabled', false);
					/*$('#state5').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/doAuth/createCall",
				data: value5,
				cache: false,
				success: function(){
					/*$('#state5').prop('disabled',false);*/
					showButton();
				}
			});
		}
		
		createCall();
	});
	
	
	
	/* SHOW_HISTORY */
	
	$(document).on('click', '#show-history', function (e) {
		e.preventDefault();
		
		$('#tb-show-history').dataTable( {
				/*"ajax": "data/arrays.txt"
				"iDisplayLength": 5,
				"bLengthChange": false,*/
				"bDestroy": true,
				"lengthMenu": [ [5, 10, 15/*, -1*/], [5, 10, 15/*, "All"*/] ],
				"ajax": {    
					"url": "/doAjax/callHistory",    
					"type": "GET",
					/*"cache": false,*/
					"data": {
					contract: $("#contractNo").val(),
					/*to: $("#to").val(),
					param: $("#param").val(),
					key: $("#key").val()*/
				}
					
			}		
		});	
			
		$("#account-history-rw").css({
			/*'position': 'fixed', 
			'z-index':'-100',*/
			
			'width': '100%',
			'min-height': '32px',
			'background': 'none',
			'position': 'fixed',
			'bottom': '0',
			'left': '0',
			'right': '0',
			'overflow': 'hidden',
			'z-index': '1',

		}).fadeIn('fast');
		
		$("#account-history").fadeIn('fast');
		
		$("#hide-history").show();
		$("#show-history").hide();
	});
	
	$(document).on('click', '#hide-history', function (e) {
		e.preventDefault();
		
		$("#account-history-rw").fadeOut('fast');
		$("#account-history").fadeOut('fast');
		
		$("#hide-history").hide();
		$("#show-history").show();
	});	
	
	$(document).on('click', '#rw-close-history', function (e) {
		e.preventDefault();
		
		$("#account-history-rw").fadeOut('fast');
		$("#account-history").fadeOut('fast');
		
		$("#hide-history").hide();
		$("#show-history").show();
	});	
	
	$(document).on('click', '#saveMessage', function (e) {
		e.preventDefault();

		var a = $("#dataCustMessage").val();
		var b = $("#contractNo").val();
		$('#message-rw').empty();
		$('#message-rw').append(a);
	
        var s = "custMessage=" + a + "&contractNo=" + b;
		$.ajax({
            type: "POST",
            url: "/doAuth/saveCustMessage",
            data: s,
            cache: false,
			success: function(){
				$("#CustMessage").hide();
				$("#saveMessage").hide();
				$("#customerMessage").show();
			}
        });

    })
		
		
	$(document).on('click', '#customerMessage', function (e) {
		e.preventDefault();
		
		$("#CustMessage").fadeIn();
		$("#customerMessage").hide();
		$("#saveMessage").show();
    });
	
});