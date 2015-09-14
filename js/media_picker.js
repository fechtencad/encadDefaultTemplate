jQuery(function($) {
	$(document).ready(function() {
		$('#header_background_image').click(function() {
			var gallery_window = wp.media({
				title: 'Insert image',
				library: {tpye: 'image'},
				multiple: false,
				button: {test: 'Insert'}
			});
			
			gallery_window.on('select', function() {
				var user_selection = gallery_window.state().get('selection').first().toJSON();
				for(prop in user_selection) {
					console.log(prop);
				}
				$('#header_background_image_url').val(user_selection.url);
			});
			
			gallery_window.open();
		});
		
		$('#header_logo_image').click(function() {
			var gallery_window = wp.media({
				title: 'Insert image',
				library: {tpye: 'image'},
				multiple: false,
				button: {test: 'Insert'}
			});
			
			gallery_window.on('select', function() {
				var user_selection = gallery_window.state().get('selection').first().toJSON();
				for(prop in user_selection) {
					console.log(prop);
				}
				$('#header_logo_image_url').val(user_selection.url);
			});
			
			gallery_window.open();
		});
		
		$('#header_background_color_image').click(function() {
			var gallery_window = wp.media({
				title: 'Insert image',
				library: {tpye: 'image'},
				multiple: false,
				button: {test: 'Insert'}
			});
			
			gallery_window.on('select', function() {
				var user_selection = gallery_window.state().get('selection').first().toJSON();
				for(prop in user_selection) {
					console.log(prop);
				}
				$('#header_background_color_image_url').val(user_selection.url);
			});
			
			gallery_window.open();
		});
		
		$('#side_menu_list_style_image').click(function() {
			var gallery_window = wp.media({
				title: 'Insert image',
				library: {tpye: 'image'},
				multiple: false,
				button: {test: 'Insert'}
			});
			
			gallery_window.on('select', function() {
				var user_selection = gallery_window.state().get('selection').first().toJSON();
				for(prop in user_selection) {
					console.log(prop);
				}
				$('#side_menu_list_style_image_url').val(user_selection.url);
			});
			
			gallery_window.open();
		});
		
	});	
});