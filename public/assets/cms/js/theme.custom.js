/* Add here all your JS customizations */
/*(function( $ ) {*/
	
	$(window).scroll(function() {

    if ($(this).scrollTop()>60)
     {
       
		$('#header-affix').slideUp('fast');
		$('#sidebar-left').addClass('sidebar-left-a');
		$('#page-header').addClass('page-header-a').slideUp('fast');
		/*var root = document.getElementsByTagName( 'html' )[0]; // '0' to assign the first (and only `HTML` tag)

		root.setAttribute( "class", "fixed sidebar-left-sm" ); */    }
    
	else
     {
		$('#header-affix').slideDown('fast');
		$('#sidebar-left').removeClass('sidebar-left-a');
		$('#page-header').removeClass('page-header-a').slideDown('fast');
	  /*$('.header').fadeIn();
	  $('.page-header').fadeIn();*/
     }
	});
	
	
/*}*/