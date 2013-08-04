var IDtramite;
var nullSearch=0;
$(document).ready(function(){
	$('#nav-tags a').click(function(){
		$('#tramites .col-lg-4').hide();
		$('#tramites .' + $(this).attr('data-tag')).show();
		$('#nav-tags a').removeClass('active');
		$(this).addClass('active');
	});

	$('#tramites .col-lg-4').click(function(){
		IDtramite = $(this).attr('data-tramite');
	});

	$('#tramites .mini-tags a').each(function(){
		$(this).addClass($(this).html());
	});

	$('#nav-tags .todos').addClass('active');
	$('#search').focus();
	$('#search').keypress(function(){
		if(!$('.tt-dataset-accounts').is(':visible')) {
			nullSearch++;
		} else {
			nullSearch = 0;
		}
		if(nullSearch>2) {
			$('#no-results').show();
			console.log('show');
		} else {
			if($('#no-results').is(':visible')) {
				$('#no-results').hide();
				console.log('hide');
			}
		}
	});
});