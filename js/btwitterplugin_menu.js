(function($) {
	$(document).ready(function(){
		if ( $('input[name="btwitterpluginmn_form_email"]').val() == '' )
			$('.btwitterplugin_system_info_mata_box .inside').css('display','none');

		$('.btwitterplugin_system_info_mata_box .handlediv').click( function(){
			if ( $('.btwitterplugin_system_info_mata_box .inside').is(":visible") ) {
				$('.btwitterplugin_system_info_mata_box .inside').css('display','none');
			} else {
				$('.btwitterplugin_system_info_mata_box .inside').css('display','block');
			}					
		});	
	});
})(jQuery);