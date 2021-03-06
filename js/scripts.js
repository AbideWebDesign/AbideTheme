jQuery(document).ready(function($) {
	var $searchlink = $('#search-toggle i');
	var $searchbar  = $('#search-bar');
	var $searchfield = $('#search-text');
	
	$('#global-header a').on('click', function(e){
	
	if($(this).attr('id') == 'search-toggle') {
		if(!$searchbar.is(":visible")) { 
			// if invisible we switch the icon to appear collapsable
			$searchlink.removeClass('fa-search').addClass('fa-search-minus');
		} else {
			// if visible we switch the icon to appear as a toggle
			$searchlink.removeClass('fa-search-minus').addClass('fa-search');
		}
		
		$searchbar.slideToggle(250, function(){
			// callback after search bar animation
			$searchfield.focus();
			});
		}
	});
	
	$('#searchform').submit(function(e){
		e.preventDefault(); // stop form submission
	});
 
});

function print_screen() {
    window.print();
}
