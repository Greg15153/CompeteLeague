
window._skel_config = {
	preset: 'standard',
	prefix: 'css/style',
	resetCSS: true,
	breakpoints: {
		'desktop': {
			grid: {
				gutters: 50
			}
		},
		'1000px': {
			grid: {
				gutters: 35
			}
		}
	}
};

window._skel_panels_config = {
	preset: 'standard'
};

jQuery(function() {
	$('#nav > ul').dropotron({ 
		offsetY: -22,
		mode: 'fade',
		noOpenerFade: true,
		speed: 300,
		detach: false
	});
});