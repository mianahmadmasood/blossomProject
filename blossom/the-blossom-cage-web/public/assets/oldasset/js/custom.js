$(document).ready(function () {

    $(".cartBox").click(function (e) {
        $('.cartBox .dropdown-menu').show();
       
    });
	 $(".headsearch").click(function (e) {
        $('.search-area-wrapper').show();
       
    });
	$(".close-btn").click(function (e) {
        $('.search-area-wrapper').hide();
       
    });
	$('.overlay2').click(function() {
		$(".search-area-wrapper").hide();	

	});
	$('.top-user-area-avatar').click(function() {
		$(".profile_drop").toggle();	

	});
	$('.profile_nav ul li').click(function() {
		$(this).addClass('active');	

	});
	
	$('.MenuBox button').click(function() {
		$(".MenuBox button").addClass("is-active");	
		$(".dashboard_menu").show("fast");	


	});
	$('.overlay_dashboard, .close-btn2').click(function() {
		$(".dashboard_menu").hide();	
		$(".MenuBox button").removeClass("is-active");	
	});
    
    $('.saleLists button').click(function() {
		$(this).toggleClass('active');
	});
    
	

});


$(document).mouseup(function (e) {
    var container = $(".cartBox .dropdown-menu, .profile_drop");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }
});