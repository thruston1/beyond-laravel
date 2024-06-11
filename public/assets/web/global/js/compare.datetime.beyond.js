$(function(){var e=new Date;var t=e.getDate();var n=e.getMonth();var r=e.getFullYear();var i=t+""+(n+1)+""+r;var s="clientStamp="+i;var o="serverStamp="+i;$.ajax({type:"POST",url:"/doAuth/getClientStamp",data:s,cache:false,success:function(e){var t=e;$.ajax({type:"POST",url:"/doAuth/getServerStamp",data:o,cache:false,success:function(e){var n=e;if(t>n||t<n){
	
	
	$("#overlay").fadeIn("fast",function(){
		
		$("#box-server").css({
			/*'position': 'fixed', */
			'z-index':'99',
			'height': '144px',
			'width': '240px',
			'background': '#FFF',
			'position': 'fixed',
			'left': '0',
			'right': '0',
			'top': '48px',
			'margin': '0 auto'
		}).fadeIn("fast");
		
		
		}
		
	);
		
		
		$("#box-close").click(function(){
			
			$("#box-server").fadeOut("fast", function() { location.reload(); });
			
			
		});
	
	
	
}}})}})})