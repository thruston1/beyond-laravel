/*$(function(){function n(){e=e+1;if(e>8){var t=1;var n="idleCode="+t;$.ajax({type:"POST",url:"/doAuth/logOff",data:n,cache:false,success:function(){$("#overlay-sleep").slideDown("fast")}})}}var e=0;var t=setInterval(n,6e4);$(this).mousemove(function(t){e=0});$(this).keypress(function(t){e=0});$("#overlay-sleep").click(function(){window.location.reload()})})*/
$(function() {
    function n() {
        e = e + 1;
        if (e > 10) {
            var stats = $("#userStat").find("option:selected").val();
			if(stats < 1){
				var t = 1;
				var n = "idleCode=" + t;
				$.ajax({
					type: "POST",
					url: "/doAuth/logOff",
					data: n,
					cache: false,
					success: function() {
						$("#_overlay_").fadeIn("fast");
					}
				})
				}
        }
    }
    var e = 0;
    var t = setInterval(n, 6e4);
    $(this).mousemove(function(t) {
        e = 0
    });
    $(this).keypress(function(t) {
        e = 0
    });
    $("#_overlay_").click(function() {
        window.location.reload()
    })
})