$(document).ready(function () {

	$(window).on('scroll', function () {
    if ($(window).scrollTop() >= 46){
        $('#head').addClass('fixed')}
    else
        {$('#head').removeClass('fixed');}
	});
	
	
});