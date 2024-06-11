$(function() {
    var e = $("#phones").val();
    /*IF number length > 0*/
	if(e.length > 0){
		if($("#state1").val() > 1 || $("#state2").val() > 1 || $("#state3").val() > 1 || $("#state4").val() > 1 || $("#state5").val() > 1 || $("#state6").val() > 1 || $("#state7").val() > 1 || $("#state8").val() > 1 || $("#state9").val() > 1){
			
			$("#vResult").prop("disabled", false);
			$("#vResult").addClass("selected");
            $("#CosiderContract").prop('disabled',false);
		}
    }
	/*Else*/
	else{
		$("#vResult").prop("disabled", true);	
        $("#CosiderContract").prop('disabled',true);
	}
	
    /*Number #1*/
	$("#state1").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers1").val(),
				filtered : $("#filtered1").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state1").val(),
				order : 1,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });
	
    /*Number #2*/
    $("#state2").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers2").val(),
				filtered : $("#filtered2").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state2").val(),
				order : 2,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });
	
    /*Number #3*/
    $("#state3").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers3").val(),
				filtered : $("#filtered3").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state3").val(),
				order : 3,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });
	
    /*Number #4*/
    $("#state4").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers4").val(),
				filtered : $("#filtered4").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state4").val(),
				order : 4,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });
	
    /*Number #5*/
    $("#state5").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers5").val(),
				filtered : $("#filtered5").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state5").val(),
				order : 5,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    })
		
    /*Number #6*/
	$("#state6").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers6").val(),
				filtered : $("#filtered6").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state6").val(),
				order : 6,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });

    /*Number #7*/
	$("#state7").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers7").val(),
				filtered : $("#filtered7").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state7").val(),
				order : 7,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });

    /*Number #8*/
	$("#state8").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers8").val(),
				filtered : $("#filtered8").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state8").val(),
				order : 8,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });

    /*Number #9*/
	$("#state9").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
            	customerid : $("#Customer_ID").val(),
				number : $("#numbers9").val(),
				filtered : $("#filtered9").val(),
				uid : $("#UNIQUE_ID").val(),
				state : $("#state9").val(),
				order : 9,
			},
            cache: false,
            success: function(e) {
				location.reload(true);
				/*var url = window.location.href;
				$(location).attr('href',url);*/													
            }
        })
    });

    /*Number #10*/
    $("#state10").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
                customerid : $("#Customer_ID").val(),
                number : $("#numbers10").val(),
                filtered : $("#filtered10").val(),
                uid : $("#UNIQUE_ID").val(),
                state : $("#state10").val(),
                order : 10,
            },
            cache: false,
            success: function(e) {
                location.reload(true);
                /*var url = window.location.href;
                $(location).attr('href',url);*/                                                 
            }
        })
    });

    /*Number #11*/
    $("#state11").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
                customerid : $("#Customer_ID").val(),
                number : $("#numbers11").val(),
                filtered : $("#filtered11").val(),
                uid : $("#UNIQUE_ID").val(),
                state : $("#state11").val(),
                order : 11,
            },
            cache: false,
            success: function(e) {
                location.reload(true);
                /*var url = window.location.href;
                $(location).attr('href',url);*/                                                 
            }
        })
    });

    /*Number #12*/
    $("#state12").change(function() {

        $.ajax({
            type: "POST",
            url: "/doAuth/saveHistory",
            data: {
                customerid : $("#Customer_ID").val(),
                number : $("#numbers12").val(),
                filtered : $("#filtered12").val(),
                uid : $("#UNIQUE_ID").val(),
                state : $("#state12").val(),
                order : 12,
            },
            cache: false,
            success: function(e) {
                location.reload(true);
                /*var url = window.location.href;
                $(location).attr('href',url);*/                                                 
            }
        })
    });
		
})