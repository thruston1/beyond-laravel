$(function() {
            
            $("#summary-close").click(function() {
                $(".summary-value").fadeOut()
            });

            $("#reload-page").click(function() {
                location.reload();
            });

            $("#_overlay").click(function() {
                $("#_overlay").fadeOut("fast");
            });

			$("#error-info").hide();
            $("#oldAddress").hide();

	$(document).on('click', '#a-show-details', function (e) {
		e.preventDefault();

		$("._show-detail").fadeOut(function(){

			$.ajax({
				type: "POST",
				url: "/doAjax/customer_hide",
				data: {
					uid : $("#UNIQUE_ID").val(),
					type : 1
				},
				beforeSend : function(){
					$("#customer_hide").text('Loading ...');
				},
				cache: false,
				success: function(h) {
					$("#customer_hide").empty().html(h);
					$("._customer-hide").fadeIn();
				}
			});

		});
	});
	$(document).on('click', '#a-show-details2', function (e) {
		e.preventDefault();

		$("._show-detail").fadeOut(function(){

			$.ajax({
				type: "POST",
				url: "/doAjax/customer_hide",
				data: {
					uid : $("#UNIQUE_ID").val(),
					type : 2
				},
				beforeSend : function(){
					$("#customer_hide").text('Loading ...');
				},
				cache: false,
				success: function(h) {
					$("#customer_hide").empty().html(h);
					$("._customer-hide").fadeIn();
				}
			});

		});
	});
	$(document).on('click', '#a-show-details3', function (e) {
		e.preventDefault();

		$("._show-detail").fadeOut(function(){

			$.ajax({
				type: "POST",
				url: "/doAjax/customer_hide",
				data: {
					uid : $("#UNIQUE_ID").val(),
					type : 3
				},
				beforeSend : function(){
					$("#customer_hide").text('Loading ...');
				},
				cache: false,
				success: function(h) {
					$("#customer_hide").empty().html(h);
					$("._customer-hide").fadeIn();
				}
			});

		});
	});
	$(document).on('click', '#a-show-details4', function (e) {
		e.preventDefault();

		$("._show-detail").fadeOut(function(){

			$.ajax({
				type: "POST",
				url: "/doAjax/customer_hide",
				data: {
					uid : $("#UNIQUE_ID").val(),
					type : 4
				},
				beforeSend : function(){
					$("#customer_hide").text('Loading ...');
				},
				cache: false,
				success: function(h) {
					$("#customer_hide").empty().html(h);
					$("._customer-hide").fadeIn();
				}
			});

		});
	});
	$(document).on('click', '#a-show-details5', function (e) {
		e.preventDefault();

		$("._show-detail").fadeOut(function(){

			$.ajax({
				type: "POST",
				url: "/doAjax/customer_hide",
				data: {
					uid : $("#UNIQUE_ID").val(),
					type : 5
				},
				beforeSend : function(){
					$("#customer_hide").text('Loading ...');
				},
				cache: false,
				success: function(h) {
					$("#customer_hide").empty().html(h);
					$("._customer-hide").fadeIn();
				}
			});

		});
	});

	$(document).on('click', '#a-hide-details', function (e) {
		e.preventDefault();

		$("#customer_hide").empty();
		$("._show-detail").fadeIn();
	});

            $("#new-address").click(function() {
                $("#overlay").fadeIn("fast", function() {
                    $("#new-address-div").animate({
                        top: "48px"
                    }, 96)
                })
            });
            $("#cancel-new-address").click(function() {
                $("#new-address-div").animate({
                    top: "-552px"
                }, 96, function() {
                    $("#overlay").fadeOut("fast");
                    location.reload()
                })
            });
            $("#userStat").change(function() {
                var e = $(this).find("option:selected").val();
                var t = "rCode=" + e;
                $.ajax({
                    type: "POST",
                    url: "/doAuth/releases",
                    data: t,
                    cache: false,
                    success: function() {
						$("#_iddle-logout").remove();
						$("#overlay").fadeIn("fast",function(){
							$("#_box-release").css({
									/*'position': 'fixed', */
									'z-index':'100',
									'height': '144px',
									'width': '240px',
									'background': '#FFF',
									'position': 'fixed',
									'left': '0',
									'right': '0',
									'top': '48px',
									'margin': '0 auto'
								}).fadeIn("fast",function(){
								$("#userStat").prop("disabled",true);
							});

							$("#realtime").empty().append("0:00:00");
							$("#_release-text").empty().append(
								$("#userStat option[value='"+ e +"']").text()
							);
						});
                    }
                })
            });
            $("#boxclose").click(function() {
                var e = $("#rCode1").val();
                var t = "rCode=" + e;
                $.ajax({
                    type: "POST",
                    url: "/doAuth/unReleases",
                    data: t,
                    cache: false,
                    success: function() {
						$("#box").fadeOut("fast", function(){

							$("#overlay").fadeOut("fast");
							$("#userStat").prop("disabled",false)

						});
                    }
                })
            });

            $("#_box-release-close").click(function() {
                var e = $("#userStat").find("option:selected").val();
                var t = "rCode=" + e;
                $.ajax({
                    type: "POST",
                    url: "/doAuth/unReleases",
                    data: t,
                    cache: false,
                    success: function() {
						$("#_box-release").fadeOut("fast", function(){

							$("#overlay").fadeOut("fast",function(){

								$("#userStat").prop("disabled",false);
								$('#userStat').prop('selectedIndex',0);
								$("#_box-release").prop("disabled",false);

							});
						}).css({'z-index':'-100'});
                    }
                })
            });


           
			$(document).on('click', '.logout-btn', function (e) {
				e.preventDefault();

				console.log('test');

					var e = 0;
					var t = "idleCode=" + e;
					$.ajax({
						type: "POST",
						url: "/doAuth/logOff",
						data: t,
						cache: false,
						success: function(_uptime) {
							if(_uptime != "_downtime"){

								$("#overlay").fadeIn("fast",function(){
									$("#_box-logout").css({
											'z-index':'100',
											'height': '144px',
											'width': '240px',
											'background': '#FFF',
											'position': 'fixed',
											'left': '0',
											'right': '0',
											'top': '48px',
											'margin': '0 auto'
										}).fadeIn("fast",function(){
									});

									$("#_logout-text").empty().append("SORRY, PLEASE LOG OUT AFTER "+ _uptime +" MINUTES, THANK YOU FOR YOUR PATIENCE AND COOPERATION");

									$("#_box-logout").effect("bounce", { times: 3, direction: "up" }, 300);
								});

							}

							else{
								window.location.reload()
							}
						}
					})
			});

			$(document).on('click', '._box-logout-close', function (e) {
				e.preventDefault();

					$("#overlay").fadeOut("fast",function(){
					$("#_box-logout").css({
						'display':'none'
						}).fadeOut("fast",function(){
					});

					$("#_logout-text").empty().append("CANT LOGIN BEFORE 30 MINUTES");

					});


			});

			$(document).on('click', '.logo', function (e) {
				e.preventDefault();

				window.location.href="/callScreen/doAction";

			});

            $("#update-cust").click(function() {
                $("#overlay").fadeIn("fast", function() {

				$("#update-cust-div").css({
					'background': '#ffffff',
					'width': '320px',
					'min-height': '320px',
					'position': 'fixed',
					'top': '48px',
					'left': '0',
					'right': '0',
					'margin': '0 auto',
					'overflow': 'hidden',
					'z-index': '100'
					}).fadeIn("fast");

                })
            });
	    $("#vResult").change(function() {
            	var d = new Date();
            	var day = d.getDate();
            	var month = d.getMonth() + 1;
            	var year = d.getFullYear();
            	if(month == 1 || month == 2 || month == 3 || month == 4 || month == 5 || month == 6 || month == 7 || month == 8 || month == 9){
            		var now = year + '-' + '0' + month + '-' + day;
            	} else {
            		var now = year + '-' + month + '-' + day;
            	}

                var t = $(this).find("option:selected").val().split(":");
                var od = $('#DAYS_OVERDUE').val();
                var n = "params=" + t[0] + "&od=" + od;

                if(od >= 0 && od <= 3){
                    var maxd = 1;
                }
                else{
                    var maxd = 3;
                }
		var maxd=$('#maxpromise').val();


                $.ajax({
                    type: "POST",
                    url: "/doAjax/parameters",
                    data: n,
                    cache: false,
                    success: function(n) {
                        $("#results-ajax-data").fadeIn("slow").html(n).promise().done(function() {
                            $("#ptpDate").datepicker("destroy");
                            $("#paidDate").datepicker("destroy");
                            $("#paidDate").datepicker({dateFormat: "yy-mm-dd"});
                            $("#ptpDate").datepicker({
                                dateFormat: "yy-mm-dd",
                                minDate: 0,
                                maxDate: maxd + "D"
                            });
                            $("#ptpDate").datepicker("setDate", Date.parse(t[4]));
                            e()
                        })
                    }
                })
            });
            $("#cancel-update-cust").click(function() {
				$("#update-cust-div").fadeOut("fast",
				function() {$("#overlay").fadeOut("fast");}

				);

            });
            $("#complaint-cust").click(function() {
                $("#overlay").fadeIn("fast", function() {

				$("#complaint-cust-div").css({
					'background': '#FFF',
					'width': '320px',
					'min-height': '32px',
					'position': 'fixed',
					'top': '48px',
					'left': '0',
					'right': '0',
					'margin': '0 auto',
					'overflow': 'hidden',
					'z-index': '100'
					}).fadeIn("fast");

                })
            });
            $("#cancel-complaint-cust").click(function() {
				$("#complaint-cust-div").fadeOut("fast",
				function() {$("#overlay").fadeOut("fast");}

				);

			});

    $("#update-cust-save").click(function() {
		var a = $("#newAddress").val();
		var b = $("#newPhone").val();
        var c = $("#newPhone2").val();
        var d = $("#newTelp").val();
        var e = $("#newTelp2").val();
        var f = $("#newTelpKantor").val();
        var g = $("#newTelpKantor2").val();
		var h = $("#UNIQUE_ID").val();
		var i = $("#AGREEMENT_NO").val();
		var j = $('#Customer_ID').val();

		if(a != '' || b != ''){

        var s = "newAddress=" + a + "&newPhone=" + b + "&uid=" + h + "&contractNo=" + i + "&newPhone2=" + c + "&newTelp=" + d + "&newTelp2=" + e + "&newTelpKantor=" + f + "&newTelpKantor2=" + g;

		$.ajax({
            type: "POST",
            url: "/doAuth/updateInfoCust",
            data: s,
            cache: false,
		});

			$("#update-cust-div").fadeOut("fast",
				function() {$("#overlay").fadeOut("fast");}

			);

		}else if(a == '' && b == ''){

			var s = "delete=true&uid=" + e ;

			$.ajax({
				type: "POST",
				url: "/doAuth/updateInfoCust",
				data: s,
				cache: false,
			});

			$("#update-cust-div").effect("bounce", {times: 3, direction: "up"}, 300);

		}
    });

    $("#save-complaint-cust").click(function() {
		var a = $("#newComplaint").val();
		var e = $("#UNIQUE_ID").val();
        // iwan
		var f = $("#AGREEMENT_NO").val();
        //end iwan
		var g = $('#Customer_ID').val();

		if(a != ''){

        var s = "newComplaint=" + a  + "&uid=" + e + "&contractNo=" + f + "&customerId=" + g;

		$.ajax({
            type: "POST",
            url: "/doAuth/updateComplainCust",
            data: s,
            cache: false,
		});

			$("#complaint-cust-div").fadeOut("fast",
				function() {$("#overlay").fadeOut("fast");}

			);

		} else if(a == '') {

        var s = "delete=true&uid=" + e ;

		$.ajax({
            type: "POST",
            url: "/doAuth/updateComplainCust",
            data: s,
            cache: false,
		});

			$("#complaint-cust-div").effect("bounce", {times: 3, direction: "up"}, 300);

		}
    })
})
