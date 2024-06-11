$(function(){
	
	/*$("#CustMessage").hide();*/
	$("#saveMessage").hide();
    $("#customerMessage").prop("disabled", false);
	
	$("#number1").click(function(){
		// alert('test');
		
		//var number1 = $("#filtered1").val();
		/*var value1 = "number="+ number1 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;*/
		//var value1 = "number="+ number1 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
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
			// alert('call');
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered1").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});
	
	$("#number2").click(function(){
		
		//var number2 = $("#filtered2").val();
		/*var value2 = "number="+ number2 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;*/
		//var value2 = "number="+ number2 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
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
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered2").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number3").click(function(){
		
		//var number3 = $("#filtered3").val();
		/*var value3 = "number="+ number3 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;*/
		//var value3 = "number="+ number3 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
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
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered3").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number4").click(function(){
		
		//var number4 = $("#filtered4").val();
		/*var value4 = "number="+ number4 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;*/
		//var value4 = "number="+ number4 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
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
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered4").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number5").click(function(){
		
		//var number5 = $("#filtered5").val();
		/*var value5 = "number="+ number5 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;*/
		//var value5 = "number="+ number5 +"&state="+ state +"&uid="+ uid +"&lkpNo=" + lkpNo +"&seqNo=" + seqNo +"&contractNo=" + contractNo +"&kodeCabang=" + kodeCabang;
		
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
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered5").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});
	
	$("#number6").click(function(){
		
		$("#number6").addClass( "grey", function(){
			
			$("#number6").prop('disabled', true);
			/*$('#state6').prop('disabled',true);*/
			$('#state6').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number6").removeClass( "grey", function(){
					
					$("#number6").prop('disabled', false);
					/*$('#state6').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered6").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number7").click(function(){
		
		$("#number7").addClass( "grey", function(){
			
			$("#number7").prop('disabled', true);
			/*$('#state7').prop('disabled',true);*/
			$('#state7').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number7").removeClass( "grey", function(){
					
					$("#number7").prop('disabled', false);
					/*$('#state7').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered7").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()

				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number8").click(function(){
		
		$("#number8").addClass( "grey", function(){
			
			$("#number8").prop('disabled', true);
			/*$('#state8').prop('disabled',true);*/
			$('#state8').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number8").removeClass( "grey", function(){
					
					$("#number8").prop('disabled', false);
					/*$('#state8').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered8").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number9").click(function(){
		
		$("#number9").addClass( "grey", function(){
			
			$("#number9").prop('disabled', true);
			/*$('#state8').prop('disabled',true);*/
			$('#state9').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number9").removeClass( "grey", function(){
					
					$("#number9").prop('disabled', false);
					/*$('#state8').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered9").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number10").click(function(){
		
		$("#number10").addClass( "grey", function(){
			
			$("#number10").prop('disabled', true);
			/*$('#state8').prop('disabled',true);*/
			$('#state10').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number10").removeClass( "grey", function(){
					
					$("#number10").prop('disabled', false);
					/*$('#state8').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered10").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number11").click(function(){
		
		$("#number11").addClass( "grey", function(){
			
			$("#number11").prop('disabled', true);
			/*$('#state8').prop('disabled',true);*/
			$('#state11').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number11").removeClass( "grey", function(){
					
					$("#number11").prop('disabled', false);
					/*$('#state8').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered11").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});

	$("#number12").click(function(){
		
		$("#number12").addClass( "grey", function(){
			
			$("#number12").prop('disabled', true);
			/*$('#state8').prop('disabled',true);*/
			$('#state12').prop('disabled',false);	
			
		});
			
		function showButton(){
			setTimeout( function(){ 
				$("#number12").removeClass( "grey", function(){
					
					$("#number12").prop('disabled', false);
					/*$('#state8').prop('disabled',false);*/	
				
				}); 
			}
			, 3000 );
		}	

		function createCall(){
			$.ajax({
				type: "POST",
				url: "/do_agi/click2call",
				data: {
					number : $("#filtered12").val(),
					state : 1,
					uid : $("#UNIQUE_ID").val(),
					customerId: $('#Customer_ID').val(),
					No_Kontrak : $("#AGREEMENT_NO").val(),
					Days_Overdue : $("#DAYS_OVERDUE").val(),
					customer_name : $("#NAME").val(),
					campaign :$("#namacampaign").val()	
				},
				cache: false,
				success: function(){
					showButton();
				}
			});
		}
		
		createCall();
	});
	
	/* SHOW_HISTORY */
	$(document).on('click', '#show-history', function (e) {
		e.preventDefault();
		
		$('#_wrap_related').css({"display" : "none"});
		
		$('#_wrap_history').show("fast", function(){
			$('#tb-show-history').show().dataTable( {
					"bDestroy": true,
					"lengthMenu": [ [5, 10, 15], [5, 10, 15] ],
					"ajax": {    
						"url": "/doAjax/callHistory",    
						"type": "GET",
						"data": {
						contract: $("#AGREEMENT_NO").val(),
						customerId: $("#Customer_ID").val(),
					}
						
				}		
			});	
		});
			
		$("#account-history-rw").css({
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

	var historyNow = false;
	/* Start GHZ CODE */
	$(document).on('click', '#show-history-payment', function (e) {
		e.preventDefault();

		if (!historyNow) {
			$('#tb-payment-history').show().dataTable( {
				"bDestroy": true,
				"lengthMenu": [ [5, 10, 15], [5, 10, 15] ],
				"ajax": {    
					"url": "/doAjax/paymentHistory",    
					"type": "GET",
					"data": {
						contract: $("#AGREEMENT_NO").val(),
						customerId: $("#Customer_ID").val(),
					}	
				}
			});
				
			$("#payment-history-rw").css({
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
			
			$("#payment-history").fadeIn('fast');
			
			$("#show-history-payment").val('CLOSE HISTORY');
			$("#show-history-payment").attr('class', 'buttonPro');
			historyNow = true;
		} else {
			historyNow = false;
			$("#payment-history-rw").fadeOut('fast');
			$("#payment-history").fadeOut('fast');
			
			$("#show-history-payment").val('SHOW HISTORY');
			$("#show-history-payment").attr('class', 'buttonPro yellow');
		
		}
	});

	$(document).on('click', '#rw-close-payment-history', function (e) {
		e.preventDefault();

		$("#payment-history-rw").fadeOut('fast');
		$("#payment-history").fadeOut('fast');
		
		$("#show-history-payment").val('SHOW HISTORY');
		$("#show-history-payment").attr('class', 'buttonPro yellow');
		historyNow = false;
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
		var b = $("#AGREEMENT_NO").val();
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
	
	
	$(document).on('click', '#_show_all_contract', function (e) {
		e.preventDefault();
		
		$("#_label_related_contract").text("RELATED CONTRACT");
		$('#_wrap_history').css({"display" : "none"});
		
		$('#_wrap_related').show("fast", function(){
			$('#tb-show-related').show().dataTable( {
					/*"ajax": "data/arrays.txt"
					"iDisplayLength": 5,
					"bLengthChange": false,*/
					"scrollX": true,
					"scrollY": "200px",
					"bDestroy": true,
					"lengthMenu": [ [5, 10, 15/*, -1*/], [5, 10, 15/*, "All"*/] ],
					"ajax": {    
						"url": "/doAjax/related_contract",    
						"type": "POST",
						/*"cache": false,*/
						"data": {
						Customer_ID: $("#Customer_ID").val(),
						/*to: $("#to").val(),
						param: $("#param").val(),
						key: $("#key").val()*/
					}
						
				}		
			});	
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
		
	
});