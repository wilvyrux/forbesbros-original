jQuery(function($){

	/* Branch div focus */
    var mainURL = document.URL
	var result= mainURL.split('/');
	var checkURL1 = result[result.length-3];
	var checkURL = result[result.length-2];
    if ( $('body').hasClass('single-forbes_branches') ) {
        $("html, body").animate({ scrollTop: $('div#asl-storelocator').offset().top }, 2000);
    }
    /* end */

	$('#career-accordion .panel').on('click', '.panel-title a', function() {
		var title = $(this).text();
		$(this).closest('.panel').find('.panel-body .gform_wrapper .gform_body .career-position input[type="text"]').val( title );
	});

	$('.single-forbes_careers .entry-content .apply-button-wrapper').on('click', '.btn-apply', function() {
		var title = $('.single-forbes_careers .career-content .career-title').text();
		var location = $('.single-forbes_careers .career-content .career-location').text();
		$('#career-form-modal .modal-header .modal-title').html('<strong><i class="fa fa-id-badge"></i> Apply for ' + title + ' position</strong>');
		$('#career-form-modal .gform_wrapper .gform_fields .career-position input[type="text"]').val(title);
		$('#career-form-modal .gform_wrapper .gform_fields .career-location input[type="text"]').val(location);
		$('#career-form-modal').modal('show');
	});

});