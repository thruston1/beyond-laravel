$(function(){
	$("#overlay").fadeIn("fast",function(){
		$("#box").css({
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
		
		}).fadeIn("fast");
		
		});
	
	$("#userStat").prop("disabled",true)
	
})